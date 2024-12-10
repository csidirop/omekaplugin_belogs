# BackendLogs Plugin for Omeka Classic

## Overview
**BackendLogs** is a plugin for [Omeka Classic](https://omeka.org/classic/) that allows backend users to access and read logs directly from the Omeka administration panel. This tool is designed to improve transparency and troubleshooting by providing easy access to log files without needing server access.

## Features
- View server logs directly from the Omeka backend
- Supports Omeka Classic logs aswell as apache2 logs

## Installation
1. Clone or download this repository to your local system.
2. Upload the plugin folder to the `/plugins` directory of your Omeka Classic installation.
3. Install the plugin via the Omeka plugin panel.
4. _TODO: config_

## Usage
1. After installation, navigate to the **Backend Logs** section in the Omeka admin panel.

## Contributing

Contributions are welcome! Please feel free to submit a pull request or open an issue if you encounter a bug or have a feature request.

## TODOs and thoughts 

- ~~Config the paths~~
- Config the ACL
- Reverse: new to old messages
- Overview strip lines
- Tabs with var logs
- Option to check if logs/reading is working (eg debug())
- Check if logging works
- Option to clear and/or trim logs
- Coloring?


## License

This plugin is released under the [GPLv3 License](https://opensource.org/licenses/GPL-3.0). See the LICENSE file for details.
