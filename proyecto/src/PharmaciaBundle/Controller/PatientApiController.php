<?php

namespace PharmaciaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use PharmaciaBundle\Entity\Patient;

 Class PatientApiController extends Controller
 {
 	/**
     * @Route("/patient/api/patient/list", name="patient_api_patient_list")
     */

	 public function listPatients()
	 {

	    $patients = $this->getDoctrine()
		->getRepository('PharmaciaBundle:Patient')
		->findAll();

	   	$response=new Response();
	    $response->headers->add(['Content-Type'=>'application/json']);
	    $response->setContent(json_encode($patients));
	    return $response;
	}


    /**
    * Creates a new patient entity.
    *
    * @Route("/patient/api/new", name="patient_new_api")
    * @Method("POST")
    */

public function newAction(Request $r)
    {
        $patients = new Patient();
        $form = $this->createForm(
            'PharmaciaBundle\Form\PatientApiType',
            $patients,
            [
                'csrf_protection' => false
            ]
        );
        $form->bind($r);
        $valid = $form->isValid();
        $response = new Response();
        if(false === $valid){
            $response->setStatusCode(400);
            $response->setContent(json_encode($this->getFormErrors($form)));
            return $response;
        }
        if (true === $valid) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($patients);
            $em->flush();
            $response->setContent(json_encode($patients));
        }
        return $response;
    }

    
    public function getFormErrors($form){
        $errors = [];
        if (0 === $form->count()){
            return $errors;
        }
        foreach ($form->all() as $child) {
            if (!$child->isValid()) {
                $errors[$child->getName()] = (string) $form[$child->getName()]->getErrors();
            }
        }
        return $errors;
    }
}
