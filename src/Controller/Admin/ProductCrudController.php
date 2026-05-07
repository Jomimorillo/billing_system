<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name'),
            TextField::new('barcode'),
            NumberField::new('basePrice'),
            AssociationField::new('baseCurrency'),
            NumberField::new('calculatedPriceVES', 'Price (VES)')
                ->hideOnForm()
                ->formatValue(function ($value, $entity) {
                    return number_format($entity->getCalculatedPriceVES(), 2);
                }),
            IntegerField::new('stock'),
        ];
    }
}
