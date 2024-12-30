<?php

declare(strict_types=1);

namespace ramazancetinkaya;

/**
 * Class ColorConverter
 * 
 * A versatile and robust PHP library designed to handle color code 
 * conversions seamlessly between various color spaces, including RGB, 
 * HEX, and HSL.
 * 
 * This library is ideal for developers building tools requiring precise 
 * color manipulation, such as graphics editors, web design utilities, 
 * and data visualization platforms.
 * 
 * @category Library
 * @package  ColorConverter
 * @author   Ramazan Çetinkaya
 * @license  MIT License <https://opensource.org/licenses/MIT>
 * @version  1.0.0
 * @link     https://github.com/ramazancetinkaya/color-code-converter
 */
class ColorConverter
{
    /**
     * Validates and normalizes a HEX color string.
     *
     * @param string $hexColor The HEX color string (e.g., "#FF00FF" or "FF00FF").
     *
     * @return string The normalized HEX color (e.g. "FF00FF").
     * @throws \InvalidArgumentException If the provided HEX color is invalid.
     */
    private function validateAndNormalizeHex(string $hexColor): string
    {
        // Remove '#' if present
        $hexColor = ltrim($hexColor, '#');

        // HEX code should be 3 or 6 characters long
        if (!preg_match('/^[0-9A-Fa-f]{3}$|^[0-9A-Fa-f]{6}$/', $hexColor)) {
            throw new \InvalidArgumentException('Invalid HEX color format.');
        }

        // If it's a 3-character code, expand to 6
        if (strlen($hexColor) === 3) {
            $hexColor = preg_replace('/./', '$0$0', $hexColor);
        }

        return strtoupper($hexColor);
    }

    /**
     * Validates an RGB color array.
     *
     * @param int[] $rgbArray The RGB array [R, G, B], values from 0 to 255.
     *
     * @return void
     * @throws \InvalidArgumentException If the provided array is invalid.
     */
    private function validateRgb(array $rgbArray): void
    {
        if (count($rgbArray) !== 3) {
            throw new \InvalidArgumentException('RGB array must contain exactly 3 elements.');
        }

        foreach ($rgbArray as $value) {
            if ($value < 0 || $value > 255) {
                throw new \InvalidArgumentException('RGB values must be in the range 0-255.');
            }
        }
    }

    /**
     * Validates an HSL color array.
     *
     * @param float[] $hslArray The HSL array [H, S, L].
     *
     * @return void
     * @throws \InvalidArgumentException If the provided array is invalid.
     */
    private function validateHsl(array $hslArray): void
    {
        if (count($hslArray) !== 3) {
            throw new \InvalidArgumentException('HSL array must contain exactly 3 elements.');
        }

        // Hue can be 0-360, saturation and lightness 0-100 (in percentages)
        [$h, $s, $l] = $hslArray;
        if ($h < 0 || $h > 360) {
            throw new \InvalidArgumentException('Hue (H) must be in the range 0-360.');
        }
        if ($s < 0 || $s > 100) {
            throw new \InvalidArgumentException('Saturation (S) must be in the range 0-100.');
        }
        if ($l < 0 || $l > 100) {
            throw new \InvalidArgumentException('Lightness (L) must be in the range 0-100.');
        }
    }

    /**
     * Converts a HEX color code to an RGB array.
     *
     * @param string $hexColor The HEX color code (e.g., "#FF0000" or "FF0000").
     *
     * @return int[] The RGB representation [R, G, B].
     */
    public function hexToRgb(string $hexColor): array
    {
        $hexColor = $this->validateAndNormalizeHex($hexColor);

        $r = hexdec(substr($hexColor, 0, 2));
        $g = hexdec(substr($hexColor, 2, 2));
        $b = hexdec(substr($hexColor, 4, 2));

        return [$r, $g, $b];
    }

    /**
     * Converts an RGB array to a HEX color code.
     *
     * @param int[] $rgbArray The RGB array [R, G, B].
     *
     * @return string The HEX color code (e.g., "#FF0000").
     */
    public function rgbToHex(array $rgbArray): string
    {
        $this->validateRgb($rgbArray);
        [$r, $g, $b] = $rgbArray;

        return sprintf("#%02X%02X%02X", $r, $g, $b);
    }

    /**
     * Converts an RGB array to an HSL array.
     *
     * @param int[] $rgbArray The RGB array [R, G, B].
     *
     * @return float[] The HSL array [H, S, L].
     */
    public function rgbToHsl(array $rgbArray): array
    {
        $this->validateRgb($rgbArray);
        [$r, $g, $b] = $rgbArray;

        // Convert to fractions of 1
        $r /= 255;
        $g /= 255;
        $b /= 255;

        $max = max($r, $g, $b);
        $min = min($r, $g, $b);
        $h = $s = $l = ($max + $min) / 2;

        if ($max === $min) {
            // Achromatic
            $h = $s = 0;
        } else {
            $d = $max - $min;
            $s = $l > 0.5 ? $d / (2 - $max - $min) : $d / ($max + $min);

            switch ($max) {
                case $r:
                    $h = (($g - $b) / $d) + ($g < $b ? 6 : 0);
                    break;
                case $g:
                    $h = (($b - $r) / $d) + 2;
                    break;
                default:
                    $h = (($r - $g) / $d) + 4;
                    break;
            }

            $h /= 6;
        }

        // Convert to degrees for Hue, percent for Saturation and Lightness
        $h = round($h * 360, 2);
        $s = round($s * 100, 2);
        $l = round($l * 100, 2);

        return [$h, $s, $l];
    }

    /**
     * Converts an HSL array to an RGB array.
     *
     * @param float[] $hslArray The HSL array [H, S, L].
     *
     * @return int[] The RGB array [R, G, B].
     */
    public function hslToRgb(array $hslArray): array
    {
        $this->validateHsl($hslArray);
        [$h, $s, $l] = $hslArray;

        // Convert HSL to fractions
        $h /= 360;
        $s /= 100;
        $l /= 100;

        if ($s == 0) {
            // Achromatic
            $r = $g = $b = $l;
        } else {
            $func = static function ($p, $q, $t) {
                if ($t < 0) {
                    $t += 1;
                }
                if ($t > 1) {
                    $t -= 1;
                }
                if ($t < 1 / 6) {
                    return $p + ($q - $p) * 6 * $t;
                }
                if ($t < 1 / 2) {
                    return $q;
                }
                if ($t < 2 / 3) {
                    return $p + ($q - $p) * (2 / 3 - $t) * 6;
                }
                return $p;
            };

            $q = $l < 0.5 ? $l * (1 + $s) : $l + $s - $l * $s;
            $p = 2 * $l - $q;

            $r = $func($p, $q, $h + 1 / 3);
            $g = $func($p, $q, $h);
            $b = $func($p, $q, $h - 1 / 3);
        }

        // Convert to 0-255 range
        $r = (int)round($r * 255);
        $g = (int)round($g * 255);
        $b = (int)round($b * 255);

        return [$r, $g, $b];
    }

    /**
     * Converts a HEX color code directly to an HSL array.
     *
     * @param string $hexColor The HEX color code (e.g., "#FF0000" or "FF0000").
     *
     * @return float[] The HSL array [H, S, L].
     */
    public function hexToHsl(string $hexColor): array
    {
        $rgbArray = $this->hexToRgb($hexColor);
        return $this->rgbToHsl($rgbArray);
    }

    /**
     * Converts an HSL array directly to a HEX color code.
     *
     * @param float[] $hslArray The HSL array [H, S, L].
     *
     * @return string The HEX color code (e.g., "#FF0000").
     */
    public function hslToHex(array $hslArray): string
    {
        $rgbArray = $this->hslToRgb($hslArray);
        return $this->rgbToHex($rgbArray);
    }
}
