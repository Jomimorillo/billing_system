<?php

namespace App\Controller\Admin;

use App\Entity\Currency;
use App\Entity\Customer;
use App\Entity\Invoice;
use App\Entity\InvoiceItem;
use App\Entity\Product;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;

#[AdminDashboard(routePath: '/admin', routeName: 'admin')]
class DashboardController extends AbstractDashboardController
{
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(ProductCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Facturación Multi-moneda');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkTo(ProductCrudController::class, 'Products', 'fas fa-box');
        yield MenuItem::linkTo(CustomerCrudController::class, 'Customers', 'fas fa-users');
        yield MenuItem::linkTo(InvoiceCrudController::class, 'Invoices', 'fas fa-file-invoice-dollar');
        yield MenuItem::linkTo(InvoiceItemCrudController::class, 'Invoice Items', 'fas fa-list');
        yield MenuItem::linkTo(CurrencyCrudController::class, 'Currencies', 'fas fa-money-bill-wave');
        yield MenuItem::linkTo(UserCrudController::class, 'Users', 'fas fa-user');
    }
}
