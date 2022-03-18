<?php

namespace App\Controller\UserBack;

use App\Entity\Customer;
use App\Entity\Image;
use App\Entity\Order;
use App\Entity\OrderItem;
use App\Entity\Product;
use App\Entity\ProductCategory;
use App\Entity\State;
use App\Entity\UserBack;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/jurassicback', name: 'user_back')]
    public function index(): Response
    {
        return $this->render('user_back/dashboard/index.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Jurassicback')
            ->setFaviconPath('img/logo_dinotoypia_32.png')
            ->renderContentMaximized()
            ;
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::section('Commandes'),
            MenuItem::linkToCrud('Commandes', 'fa fa-cart-plus', Order::class),
            MenuItem::linkToCrud('Objects des commandes', 'fa fa-cart-plus', OrderItem::class),

            MenuItem::section('Produits')->setPermission('ROLE_DEV'),
            MenuItem::linkToCrud('Produits', 'fa fa-tags', Product::class)->setPermission('ROLE_DEV'),
            MenuItem::linkToCrud('Catégories', 'fa fa-tags', ProductCategory::class)->setPermission('ROLE_DEV'),
            MenuItem::linkToCrud('Images', 'fa fa-tags', Image::class)->setPermission('ROLE_DEV'),

            MenuItem::section('Admin')->setPermission('ROLE_ADMIN'),
            MenuItem::linkToCrud('Clients', 'fa fa-user', Customer::class)->setPermission('ROLE_ADMIN'),
            MenuItem::linkToCrud('Utilisateurs', 'fa fa-user', UserBack::class)->setPermission('ROLE_ADMIN'),
            MenuItem::linkToCrud('États', 'fa', State::class)->setPermission('ROLE_ADMIN'),
        ];
    }
}
