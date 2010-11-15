<?php

namespace googlemaps\overlay;

/**
 * Marker Icon class
 * Attach these to markers to display custom marker icons
 * 
 * Example:
 * $icon = new \GoogleMaps\Marker\MarkerIcon( $icon_url );
 * $icon->setSize( 30, 30 );
 * $shadow = \GoogleMaps\Marker\MarkerIcon::create( $shadow_url )->setAnchor( 0, 30 );
 * $marker->setIcon( $icon );
 * $marker->setShadow( $shadow );
 */
 

class MarkerIcon  extends \googlemaps\core\MapObject {

	/**
	 * Url of the icon image
	 *
	 * @var string
	 */
	protected $icon;

	/**
	 * Width of the icon
	 *
	 * @var integer
	 */
	protected $width;

	/**
	 * Height of the icon
	 *
	 * @var integer
	 */
	protected $height;

	/**
	 * X coord of the anchor
	 *
	 * @var integer
	 */
	protected $anchor_x;

	/**
	 * Y coord of the anchor
	 *
	 * @var integer
	 */
	protected $anchor_y;

	/**
	 * X coord of the origin
	 *
	 * @var integer
	 */
	protected $origin_x;

	/**
	 * Y coord of the origin
	 *
	 * @var integer
	 */
	protected $origin_y;

	/**
	 * Constructor
	 * Sets the icon's image URL, width, height, origin and anchor
	 * default origin ( 0, 0 )
	 * default anchor ( w/2, h )
	 *
	 * Throws an exception if the icon is invalid
	 *
	 * @param strin $icon URL of the icon image
	 * @throws Exception
	 * @return MarkerIcon
	 */
	public function __construct( $icon, array $options = null ) {

		$size = @getimagesize( $icon );
		if ( !$size ) {
			throw new Exception( 'unable to load MarkerIcon: ' . $icon );
		}

		$this->icon = $icon;

		if ( !isset( $options['width'] ) || !isset( $options['height'] ) ) {
			list( $this->width, $this->height ) = $size;
		}
		else {
			$this->width = (int) $options['width'];
			$this->height = (int) $options['height']; 
		}
		
		$this->anchor_x = isset( $options['anchor_x'] ) ? $options['anchor_x'] : floor( $this->width / 2 );
		$this->anchor_y = isset( $options['anchor_y'] ) ? $options['anchor_y'] : $this->height;
		$this->origin_x = isset( $options['origin_y'] ) ? $options['origin_x'] : 0;
		$this->origin_y = isset( $options['origin_y'] ) ? $options['origin_y'] : 0;

		return $this;

	}

	/**
	 * Static create method useful for method chaining
	 *
	 * @param strin $icon URL of the icon image
	 * @throws Exception
	 * @return MarkerIcon
	 */
	public static function create( $icon, array $options=null ) {
		return new MarkerIcon( $icon, $options );
	}

	/**
	 * Set the icon's height
	 *
	 * @param int $height
	 * @return MarkerIcon
	 */
	public function setHeight( $height ) {
		$this->height = (int) $height;
		return $this;
	}

	/**
	 * Set the icon's width
	 *
	 * @param int $width
	 * @return MarkerIcon
	 */
	public function setWidth( $width ) {
		$this->width = (int) $width;
		return $this;
	}

	/**
	 * Set the icon's size (width/height)
	 *
	 * @param int $width
	 * @param int $height
	 * @return MarkerIcon
	 */
	public function setSize( $width, $height ) {
		$this->height = (int) $height;
		$this->width = (int) $width;
		return $this;
	}

	/**
	 * Set the icon's anchor point
	 * This is the point on the icon that will be placed on the map
	 *
	 * @param int $x X coord of the anchor
	 * @param int $y Y coord of the anchor
	 * @return MarkerIcon
	 */
	public function setAnchor( $x=null, $y=null ) {
		if ( $x !== null ) {
			$this->anchor_x = (int) $x;
		}
		if ( $y !== null ) {
			$this->anchor_y = (int) $y;
		}
		return $this;
	}


	/**
	 * Set the icon's origin point
	 * This is used when you are using a sprite for the marker
	 *
	 * @param int $x X coord of the origin
	 * @param int $y Y coord of the origin
	 * @return MarkerIcon
	 */
	public function setOrigin( $x=null, $y=null ) {
		if ( $x !== null ) {
			$this->origin_x = (int) $x;
		}
		if ( $y !== null ) {
			$this->origin_y = (int) $y;
		}
		return $this;
	}
	
}