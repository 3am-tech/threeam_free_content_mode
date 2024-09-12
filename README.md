# ThreeAM Free Content Mode

## Description

The `threeam_free_content_mode` TYPO3 extension provides a context menu item for pages in the TYPO3 page tree, allowing you to set a page into "Free Mode" with just a click. This is particularly useful when working with the Container extension, which might not function properly with mixed mode content elements. This extension automates the process of switching a page to Free Mode, reducing manual effort.

## Features

- Adds a custom "Free Mode" action to the page tree context menu.
- Automates switching a page to Free Mode to resolve issues with content management in mixed mode.
- Simplifies workflow for TYPO3 installations using the Container extension.

## Installation

### Composer Installation
1. Run the following command to add the extension via Composer:

    ```bash
    composer req threeam/threeam-free-content-mode
    ```

2. Activate the extension via the TYPO3 Extension Manager in the backend.

### Manual Installation
1. Download the extension as a zip file and extract it to the `typo3conf/ext/` directory.
2. Navigate to the TYPO3 backend, go to the **Extension Manager**, and activate the extension.

## Usage

After installation:
1. Right-click any page in the TYPO3 page tree.
2. In the context menu, you will see a new action titled "Free Mode."
3. Clicking on this action will automatically switch the page to Free Mode, allowing you to use the Container extension and other features that require do not work in mixed mode.

