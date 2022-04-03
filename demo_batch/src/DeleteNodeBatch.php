<?php

namespace Drupal\demo_batch;


use Drupal\node\Entity\Node;
use Drupal\Core\Messenger\MessengerTrait;

class DeleteNodeBatch {

  public static function deleteNodeExample($nids, &$context){
    $message = 'Deleting Node...';
    $results = array();
    foreach ($nids as $nid) {
      $node = Node::load($nid);
      $results[] = $node->delete();
    }
    $context['message'] = $message;
    $context['results'] = $results;
  }

  public static function deleteNodeExampleFinishedCallback($success, $results, $operations) {
    // The 'success' parameter means no fatal PHP errors were detected. All
    // other error management should be handled using 'results'.
    if ($success) {
      $message = \Drupal::translation()->formatPlural(
        count($results),
        'One post processed.', '@count posts processed.'
      );
    }
    else {
      $message = t('Finished with an error.');
    }
    \Drupal::messenger()->addStatus('example message'.$message);
  }
}