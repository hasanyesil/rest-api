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
        for ($i = 0; $i<20; $i++){
            $order = new Order();
            $order->setProductId($i);
            $order->setQuantity(rand(1,9999));
            $order->setAddress("testaddress");
            $order->setShippingDate(new \DateTime());
            $order->setCustomer($this->getReference('customer_'.rand(1,3)));

            $manager->persist($order);
        }

        $manager->flush();
    }

    public function loadCustomer(ObjectManager $manager){
        for ($i = 1; $i<4; $i++){
            $customer = new Customer();
            $customer->setCustomername('test'.$i);
            $customer->setPassword($this->passwordEncoder->encodePassword($customer,'test'.$i));

            $this->addReference('customer_'.$i,$customer);

            $manager->persist($customer);
        }
        $manager->flush();
    }
}
