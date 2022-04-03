<?php

namespace Drupal\demo_batch\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\FormBase;

class DeleteNodesForm extends FormBase{

/**
 * {@inheritdoc}
 */
    public function getFormId(){
        return 'batch_example_form';

    }

/**
 * {@inheritdoc}
 */
    public function buildForm(array $form, FormStateInterface $form_state){
        
        $form['delete_node'] = array(
            '#type'=>'submit',
            '#value'=> $this->t('Delete Nodes'),
        );

        return $form;

    }
/**
 * {@inheritdoc}
 */

    public function submitForm(array &$form, FormStateInterface $form_state){
        $nids = \Drupal::entityQuery('node')
                ->condition('type', 'article')
                ->sort('created', 'ASC')
                ->execute();

        $batch = array(
        'title' => t('Deleting Node...'),
        'operations' => array(
            array(
            '\Drupal\demo_batch\DeleteNodeBatch::deleteNodeExample',
            array($nids)
            ),
        ),
        'finished' => '\Drupal\demo_batch\DeleteNodeBatch::deleteNodeExampleFinishedCallback',
        );

        batch_set($batch);
    }


}