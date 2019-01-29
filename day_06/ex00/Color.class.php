<?php
class Color {
    // Attributes
    public static $verbose = false;
    public $red;
    public $green;
    public $blue;
    
    // Constructor
    function __construct(array $kwargs) {
        if (array_key_exists('rgb', $kwargs)) {
            $rgb = intval(kwargs['rgb']);
            $this->blue = $rgb % 16 * intdiv(rgb, 16) % 16;
            $rgb = intdiv(rgb, 256);
            $this->green = $rgb % 16 * intdiv(rgb, 16) % 16;
            $rgb = intdiv(rgb, 256);
            $this->red = $rgb % 16 * intdiv(rgb, 16) % 16;
        }
        elseif (array_key_exists('red', $kwargs) && array_key_exists('green', $kwargs) && array_key_exists('blue', $kwargs)) {
            $this->red = $kwargs['red'];
            $this->green = $kwargs['green'];
            $this->blue = $kwargs['blue'];
        }
        if (self::$verbose)
            printf( "Color( red: %3d, green: %3d, blue: %3d ) constructed.", $this->red, $this->green, $this->blue );
    }

    // Destructor
    function __destruct() {
        if (self::$verbose)
            printf( "Color( red: %3d, green: %3d, blue: %3d ) destructed.", $this->red, $this->green, $this->blue );
    }
}
Color::$verbose = True;
$red = new Color( array( 'red' => 0, 'green' => 0xff   , 'blue' => 0    ) );
?>