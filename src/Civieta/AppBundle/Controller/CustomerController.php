<?php
/**
 * User: Daniel Cruz
 * Date: 11/01/2015
 * Time: 13:30
 */

namespace Civieta\AppBundle\Controller;

use Civieta\AppBundle\Entity\Customer;
use Civieta\AppBundle\Form\Types\CustomerType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/customer")
 */
class CustomerController extends Controller
{
    /**
     * @Route("/new", name="create_customer")
     * @Method("GET|POST")
     */
    public function createCustomer(Request $request)
    {
        $customer = new Customer();
        $customerForm = $this->createForm(new CustomerType(), $customer);

        $customerForm->handleRequest($request);
        if ($customerForm->isValid()) {
            ldd($customer);
        }
        
        return $this->render('::Customer/customer.html.twig', [
            'title' => 'Crear cliente',
            'customerForm' => $customerForm->createView()
        ]);
    }
}