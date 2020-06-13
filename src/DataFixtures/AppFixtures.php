<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use App\Entity\Order;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->passwordEncoder = $userPasswordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $this->loadCustomer($manager);
        $this->loadOrders($manager);
        $manager->flush();
    }

    public function loadOrders(ObjectManager $manager){
        $order = new Order();
        $order->setOrderCode(uniqid());
        $order->setProductId(1);
        $order->setQuantity(100);
        $order->setAddress("testaddress");
        $order->setShippingDate(new \DateTime());
        $order->setCustomer($this->getReference('customer'));

        $manager->persist($order);
        $manager->flush();
    }

    public function loadCustomer(ObjectManager $manager){
        $customer = new Customer();
        $customer->setCustomername('test3');
        $customer->setPassword($this->passwordEncoder->encodePassword($customer,'test3'));

        $this->addReference('customer',$customer);

        $manager->persist($customer);
        $manager->flush();
    }
}
