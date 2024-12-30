# Color Code Converter

![PHP Version](https://img.shields.io/badge/PHP-8.0%2B-777bb4?style=for-the-badge&logo=php&logoColor=white)
[![Packagist](https://img.shields.io/packagist/v/ramazancetinkaya/color-code-converter?style=for-the-badge&color=34C759)](https://packagist.org/packages/ramazancetinkaya/color-code-converter)
![Downloads](https://img.shields.io/packagist/dt/ramazancetinkaya/color-code-converter?style=for-the-badge&color=orange)
![License](https://img.shields.io/badge/License-MIT-blue?style=for-the-badge&logo=open-source-initiative&logoColor=white)
[![Stars](https://img.shields.io/github/stars/ramazancetinkaya/color-code-converter?style=for-the-badge&color=FAD02E&logo=github)](https://github.com/ramazancetinkaya/color-code-converter/stargazers)
[![Issues](https://img.shields.io/github/issues/ramazancetinkaya/color-code-converter?style=for-the-badge&color=E4405F&logo=github)](https://github.com/ramazancetinkaya/color-code-converter/issues)

A **powerful, modern, and extensible PHP library** for converting color codes between various color spaces, such as **RGB**, **HEX**, and **HSL**. Designed with a focus on readability, scalability, and production readiness, this library is the ultimate solution for color manipulation.

<a href="https://github.com/ramazancetinkaya/color-code-converter/issues">Report a Bug</a>
·
<a href="https://github.com/ramazancetinkaya/color-code-converter/pulls">New Pull Request</a>

### ⭐ Show Your Support

If you like this project, give it a ⭐ and share it with your network!

---

## Features

✨ **Versatile Color Conversions**  
Effortlessly convert color codes between popular formats:  
- 🔄 **RGB ↔ HEX**  
- 🔄 **RGB ↔ HSL**  
- 🔄 **HEX ↔ HSL**

⚡ **Modern PHP Standards**  
Built with PHP 8+ features for high performance and future-proof compatibility:  
- 🏷️ Strict typing (`strict_types=1`)  
- 🛠️ Fully typed methods  

🛡️ **Robust Error Handling**  
- 🔍 Input validation with detailed exceptions  
- 🛑 Catch invalid formats before they propagate

🧩 **Extensible Architecture**  
- 📦 Add support for additional color spaces (e.g., CMYK, LAB) with ease  
- 🏗️ Modular design for seamless integration  

📘 **Comprehensive Documentation**  
- 📝 Fully documented methods with standardized PHPDoc comments  
- 📚 Clear usage examples  

🌐 **Production-Ready**  
- 🔒 Secure and reliable for real-world applications  
- ⚙️ Optimized for maintainability and scalability

## Installation

### Using Composer

You can install the `ColorCode` library using [Composer](https://getcomposer.org/). Run the following command in your terminal:

```bash
composer require ramazancetinkaya/color-code-converter
```

### Manual Installation

Alternatively, download the source code and include it in your project manually. 

1. Clone the repository:
   ```bash
   git clone https://github.com/ramazancetinkaya/color-code-converter.git
   ```
2. Include the library in your project:
   ```php
   require 'path/to/ColorConverter.php';
   ```
   
## Usage

Here's how you can use the `ColorConverter` class:

```php
<?php

require 'vendor/autoload.php';

use ramazancetinkaya\ColorConverter;

$converter = new ColorConverter();

// Convert HEX to RGB
$rgb = $converter->hexToRgb('#FF5733'); // [255, 87, 51]

# echo '<pre>' . print_r($rgb, true) . '</pre>';

// Convert RGB to HEX
$hex = $converter->rgbToHex([255, 87, 51]); // "#FF5733"

# echo $hex;

// Convert RGB to HSL
$hsl = $converter->rgbToHsl([255, 87, 51]); // [10.59, 100, 60]

# echo '<pre>' . print_r($hsl, true) . '</pre>';

// Convert HSL to RGB
$rgb2 = $converter->hslToRgb([14.29, 100, 60]); // [255, 100, 51]

# echo '<pre>' . print_r($rgb2, true) . '</pre>';

// Convert HEX to HSL
$hsl2 = $converter->hexToHsl('#FF5733'); // [10.59, 100, 60]

# echo '<pre>' . print_r($hsl2, true) . '</pre>';

// Convert HSL to HEX
$hex2 = $converter->hslToHex([14.29, 100, 60]); // "#FF5733"

# echo $hex2;
```

## API Documentation

### `hexToRgb(string $hexColor): array`

Converts a HEX color string to its RGB representation.

- **Parameters**:
  - `$hexColor` *(string)*: The HEX color string (e.g., `"#FF5733"`, `"FF5733"`).
- **Returns**:
  - *(array)*: An RGB array `[R, G, B]` with values between `0-255`.

---

### `rgbToHex(array $rgbArray): string`

Converts an RGB array to a HEX color string.

- **Parameters**:
  - `$rgbArray` *(array)*: An array `[R, G, B]` with values between `0-255`.
- **Returns**:
  - *(string)*: The HEX color string (e.g., `"#FF5733"`).

---

### `rgbToHsl(array $rgbArray): array`

Converts an RGB array to its HSL representation.

- **Parameters**:
  - `$rgbArray` *(array)*: An array `[R, G, B]` with values between `0-255`.
- **Returns**:
  - *(array)*: An HSL array `[H, S, L]` where:
    - `H` (Hue): `0-360`
    - `S` (Saturation): `0-100` (%)
    - `L` (Lightness): `0-100` (%)

---

### `hslToRgb(array $hslArray): array`

Converts an HSL array to its RGB representation.

- **Parameters**:
  - `$hslArray` *(array)*: An array `[H, S, L]` where:
    - `H` (Hue): `0-360`
    - `S` (Saturation): `0-100` (%)
    - `L` (Lightness): `0-100` (%)
- **Returns**:
  - *(array)*: An RGB array `[R, G, B]` with values between `0-255`.

## Project Structure

```plaintext
src/
├── ColorConverter.php
composer.json
README.md
LICENSE
```

## Security

This library is designed with security in mind. Input validation and error handling are implemented to prevent misuse. For vulnerabilities, please [open an issue](https://github.com/ramazancetinkaya/color-code-converter/issues).

## Contributing

Contributions are welcome! Please feel free to submit a pull request or open an issue for any enhancements or bug fixes.

## Authors

This project is maintained with ❤️ by:

- **[Ramazan Çetinkaya](https://github.com/ramazancetinkaya)** - *Developer*
  - GitHub: [@ramazancetinkaya](https://github.com/ramazancetinkaya)

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for more details.
