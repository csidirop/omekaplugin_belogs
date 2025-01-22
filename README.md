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

## Configuration
1. After installation or at any time a superuser wants to configure it there is a handy configuration page
2. The page has three parts:
    1. Check Logging Configuration: Checks the configurations for the set logging configuration. The most common logging configurations are given as examples.
    2. Configure Log Paths: Allows you to set custom log paths.
    3. Configure Access Rights: restrict the access to the BE logs to specific roles (super is always set).

## Usage
1. After configuration, navigate to the **Backend Logs** section in the Omeka backend panel.

## Contributing

Contributions are welcome! Please feel free to submit a pull request or open an issue if you encounter a bug or have a feature request.

## TODOs and thoughts

- [x] Config the paths (-> done in #78956d6 )
- [x] Config the ACL (-> done in #b07d649 )
- [ ] Reverse: new to old messages
- [x] Overview strip lines
- [x] Tabs with var logs
- [x] Option to check if logs/reading is working (eg debug()) (-> done in #9ed3aa6)
- [x] Check if logging is active
- [x] Option to clear and/or trim logs (-> done in #5e85850 and #9ed3aa6 )
- [ ] Coloring?


## License

This plugin is released under the [GPLv3 License](https://opensource.org/licenses/GPL-3.0). See the LICENSE file for details.
