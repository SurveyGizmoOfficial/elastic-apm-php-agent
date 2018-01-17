<?php
namespace PhilKra\Middleware;

use GuzzleHttp\Psr7\Request;
use \PhilKra\Transaction\Transaction;
use \PhilKra\Transaction\ITransaction;

/**
 * Connector which Transmits the Data to the Endpoints
 */
class Connector {

  /**
   * Agent Config
   *
   * @var array
   */
  private $config;

  /**
   * @param array $config
   */
  public function __construct( array $config ) {
    $this->config = $config;
  }

  /**
   * Push the Transactions to APM Server
   *
   * @param string $json
   *
   * @return
   */
  public function pushTransactions( string $json ) {
    $request = new Request(
      'POST',
      $this->config['serverUrl'],
      $this->getRequestHeaders(),
      $json
    );
  }

  /**
   * Push the Errors to APM Server
   *
   * @param string $json
   *
   * @return
   */
  public function pushErrors( string $json ) {
    $request = new Request(
      'POST',
      $this->config['serverUrl'],
      $this->getRequestHeaders(),
      $json
    );
  }

  /**
   * Get the Headers for the POST Request
   *
   * @return array
   */
  private function getRequestHeaders() : array {
    // Default Headers Set
    $headers = [
      'Content-Type' => 'application/json',
    ];

    // Add Secret Token to Header
    if( $this->config['secretToken'] !== null ) {
//      $headers['SECRET'] = $this->config['secretToken'];
    }

    return $headers;
  }

}
