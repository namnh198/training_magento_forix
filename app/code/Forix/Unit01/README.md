## Create a new module. Make a mistake in its config. Create a second module dependent on the first.
- Missing etc/module.xml: `The contents from the "etc/module.xml" file can't be read. Warning!file_get_contents(etc/module.xml): failed to open stream: No such file or directory`
- Change `</module>` to `</mod>`: `Warning: DOMDocument::loadXML(): Opening and ending tag mismatch: module line 9 and mod in Entity, line: 10
  in /var/www/magento/m2/lib/internal/Magento/Framework/Xml/Parser.php on line 159.`
- Missing registration.php: `Module doesn't enable` 

## Under what circumstances will clean the var/cache folder not work?
- File or Folder permissions are not set correctly.
- Use External caching (Redis, Memcached)

## What kind of pattern do you notice?

List 5 Class at module Magento_Catalog

- Magento\Catalog\Controller\Adminhtml\Product
- Magento\Catalog\Helper\Product
- Magento\Catalog\EntityCreator\MetadataPool
- Magento\Catalog\Model\ProductManagement
- Magento\Catalog\Observer\ImageResizeAfterProductSave

Pattern:

- **Dependency Injection**: The Constructor has a list of objects assigned to properties and then used inside class.
