<?php
/**
 * User: Daniel Cruz
 * Date: 11/01/2015
 * Time: 13:30
 */

namespace Civieta\AppBundle\Controller;

use Civieta\AppBundle\Entity\Customer;
use Civieta\AppBundle\Form\Types\CustomerType;
use Civieta\AppBundle\Repository\CustomerRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/customer")
 */
class CustomerController extends Controller
{
    /**
     * @param Request $request
     * @Route("/show", name="show_customers")
     */
    public function showCustomers(Request $request)
    {
        $repository = $this->get('doctrine')->getRepository('AppBundle:Customer');
        $customers = $repository->findAll();

        return $this->render('::Customer/customers.html.twig', ['customers' => $customers]);
    }

    /**
     * @Route("/new", name="create_customer")
     * @Method("GET|POST")
     */
    public function createCustomerAction(Request $request)
    {
        $customer = new Customer();
        $customerForm = $this->createForm(new CustomerType(), $customer);

        $customerForm->handleRequest($request);
        if ($customerForm->isValid()) {
            $manager = $this->get('doctrine')->getManager();

            if (null !== $customer->getFileImage()) {
                $imagePath = $this->container->getParameter('upload_path');
                $filename = $customer->uploadImage('customer', $imagePath);

                if ($customer->getPathImage() && is_file($customer->getPathImage())) {
                    unlink($imagePath . '/' . $customer->getPathImage());
                }

                $customer->setPathImage($filename);
            }

            $manager->persist($customer);
            $manager->flush();

            return $this->redirect($this->generateUrl('show_customers'));
        }
        
        return $this->render('::Customer/customer.html.twig', [
            'title' => 'Crear cliente',
            'customerForm' => $customerForm->createView()
        ]);
    }

    /**
     * @Route("/edit/{customer}", name="edit_customer")
     * @Method("GET|POST")
     */
    public function editCustomerAction(Request $request,$customer)
    {
        /** @var CustomerRepository $repository */
        $repository = $this->get('doctrine')->getRepository('AppBundle:Customer');
        $customer = $repository->findCompleteCustomer($customer);
        $customerForm = $this->createForm(new CustomerType(), $customer);

        $customerForm->handleRequest($request);
        if ($customerForm->isValid()) {
            $manager = $this->get('doctrine')->getManager();

            if (null !== $customer->getFileImage()) {
                $imagePath = $this->container->getParameter('upload_path');
                $filename = $customer->uploadImage('customer', $imagePath);

                if ($customer->getPathImage() && is_file($imagePath . '/' . $customer->getPathImage())) {
                    unlink($imagePath . '/' . $customer->getPathImage());
                }

                $customer->setPathImage($filename);
            }

            $manager->flush();

            return $this->redirect($this->generateUrl('show_customers'));
        }

        return $this->render('::Customer/customer.html.twig', [
            'title' => 'Editar cliente',
            'customerForm' => $customerForm->createView(),
            'customer' => $customer,
        ]);
    }
}