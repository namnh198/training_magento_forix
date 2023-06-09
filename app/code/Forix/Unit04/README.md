## Create a text input attribute (1) from admin interface

Steps:
1. Log in to the Magento Admin.
2. Select Stores -> Attributes -> Product in the main navigation
3. Click the Add New Attribute button
4. Enter an attribute label
5. Select the tab Frontend Properties
6. Set Visible on Catalog Pages on Frontend to Yes
7. Click Save Attribute
8. Select Stores -> Attributes -> Attribute Sets in the main navigation
9. In the list, select an Attribute Set, for example the Bag attribute set
10. Drag and drop the Flavors attribute icon from the right Unassigned Attributes column onto the Product Details attribute group folder icon.
11. Confirm that the Flavors attribute icon now is listed within the Product Details attribute group.
12. Click Save button
13. Select Catalog -> Inventory -> Products in the main navigation
14. In the Attribute Set column filter dropdown, select Bag and click the Search button
15. Select a product from the list where the Visibility is set to Catalog, Search
16. Confirm that the Flavors attribute field is displayed on the Product Details form
17. Enter a value for the Flavors attribute, for example Strawberry
18. Click the Save button
19. Open the product in the Magento storefront
20. Select the More Information tab
21. Confirm that the new attribute and the value you gave it are displayed


## Find out how Magento add attributes to the collection in these 3 cases. (select/filter/order)

- `addAttributeToSelect`: Magento adds the specified attributes to the collection's select query. It modifies the query's columns clause to include the attribute columns in the result set. This ensures that the selected attributes are retrieved from the database when the collection is loaded.
- `addAttributeToFilter`: Magento extends the collection's SQL query by adding appropriate conditions to the where clause. It determines the appropriate database table and column to filter based on the attribute's backend type and applies the necessary conditions to retrieve the desired results.
- `addAttributeToSort`: Magento adds the attribute's column to the collection's SQL query's order by clause. It determines the appropriate table and column based on the attribute's backend type and applies the sorting condition to retrieve the collection in the specified order.
