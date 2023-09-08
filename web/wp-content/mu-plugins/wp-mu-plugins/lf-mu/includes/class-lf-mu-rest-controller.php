<?php
/**
 * Registers controller for LF API endpoints.
 *
 * @link       https://www.cncf.io/
 * @since      1.0.0
 *
 * @package    Lf_Mu
 * @subpackage Lf_Mu/includes
 */

/**
 * Registers controller for LF API endpoints.
 * Class template comes from https://developer.wordpress.org/rest-api/extending-the-rest-api/adding-custom-endpoints/#examples.
 *
 * @since      1.0.0
 * @package    Lf_Mu
 * @subpackage Lf_Mu/includes
 * @author     Chris Abraham <cjyabraham@gmail.com>
 */
class LF_MU_REST_Controller extends WP_REST_Controller {

	/**
	 * Register the routes for the objects of the controller.
	 */
	public function register_routes() {
		$version = '1';
		$namespace = 'lf/v' . $version;
		$base = 'sync_presentations';
		register_rest_route(
			$namespace,
			'/' . $base,
			array(
				array(
					'methods'             => WP_REST_Server::ALLMETHODS,
					'callback'            => array( $this, $base ),
					'permission_callback' => '__return_true',
					'args'                => array(),
				),
			)
		);
	}

	/**
	 * Sync Presentations with the GitHub Presentations repo.
	 *
	 * @param WP_REST_Request $request Full data about the request.
	 * @return WP_Error|WP_REST_Response
	 */
	public function sync_presentations( $request ) {

		if ( ! is_object( $request ) ) {
			return new WP_Error( 'error', esc_html__( 'Error with the request object.' ), array( 'status' => 500 ) );
		}

		$json = json_decode( $request->get_body() );

		if ( is_object( $json ) && property_exists( $json, 'repository' ) && property_exists( $json, 'action' ) && property_exists( $json, 'pull_request' ) ) {
			if ( 'presentations' === $json->repository->name && 'closed' === $json->action && true === $json->pull_request->merged ) {
				// sync presentations after 10 minutes.
				// This delay is required in order for GitHub to update its raw presentations.yaml file.
				wp_schedule_single_event( time() + 600, 'cncf_sync_presentations' );
				return new WP_REST_Response( array( 'Success. Presentations synced.' ), 200 );
			}
		}

		return new WP_REST_Response( array( 'Success' ), 200 );
	}

}
