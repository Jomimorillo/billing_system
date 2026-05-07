<?php

namespace App\EventSubscriber;

use App\Entity\Invoice;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class InvoiceSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['calculateTotal'],
            BeforeEntityUpdatedEvent::class => ['calculateTotal'],
        ];
    }

    public function calculateTotal($event)
    {
        $entity = $event->getEntityInstance();

        if (!($entity instanceof Invoice)) {
            return;
        }

        $total = 0;
        foreach ($entity->getItems() as $item) {
            $product = $item->getProduct();
            if ($product) {
                $priceVES = $product->getCalculatedPriceVES();
                $item->setUnitPriceVES($priceVES);
                $total += $priceVES * $item->getQuantity();
            }
        }
        $entity->setTotalVES($total);
    }
}
