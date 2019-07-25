<?php
/**
 * Created by PhpStorm.
 * User: edward
 * Date: 2019-01-15
 * Time: 15:51
 */

namespace Palasthotel\ProcessLog;


/**
 * @property Writer writer
 */
class ErrorWatcher {

	public function __construct( Plugin $plugin ) {
		$this->writer = $plugin->writer;
		\register_shutdown_function( array( $this, 'onError' ) );
	}

	public function onError() {
		$error = error_get_last();
		if ($error['type'] === E_ERROR) {
			$this->writer->addLog(
				ProcessLog::build()
				          ->setEventType( Plugin::EVENT_TYPE_ERROR )
				          ->setSeverity( Plugin::SEVERITY_TYPE_FATAL )
				          ->setVariables( $error )
			);
		}
	}
}