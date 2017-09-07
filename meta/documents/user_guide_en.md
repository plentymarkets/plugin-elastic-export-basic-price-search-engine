# ElasticExportBasicPriceSearchEngine plugin user guide

<div class="container-toc"></div>

## 1 Setting up the data format BasicPriceSearchEngine-Plugin in plentymarkets

To use this format, you need the Elastic Export plugin.

Follow the instructions given on the [Exporting data formats for price search engines](https://knowledge.plentymarkets.com/en/basics/data-exchange/exporting-data#30) page of the manual to set up FashionDE-Plugin in plentymarkets.

The following table lists details for settings, format settings and recommended item filters for the format **BasicPriceSearchEngine-Plugin**.
<table>
    <tr>
        <th>
            Settings
        </th>
        <th>
            Explanation
        </th>
    </tr>
    <tr>
        <td class="th" colspan="2">
            Settings
        </td>
    </tr>
    <tr>
        <td>
            Format
        </td>
        <td>
            Choose <b>BasicPriceSearchEngine-Plugin</b>.
        </td>
    </tr>
    <tr>
        <td>
            Provisioning
        </td>
        <td>
            Choose <b>URL</b>.
        </td>
    </tr>
    <tr>
        <td>
            File name
        </td>
        <td>
        	The file name must have the ending <b>.csv</b> for price search engines or equal interfaces to be able to import the file successfully.
        </td>
    </tr>
    <tr>
        <td class="th" colspan="2">
            Item filter
        </td>
    </tr>
    <tr>
        <td>
            Activ
        </td>
        <td>
            Choose <b>Activ</b>.
        </td>
    </tr>
    <tr>
        <td>
            Markets
        </td>
        <td>
            Choose one or multiple order referrers. The chosen order referrer has to be active at the variation for the item to be exported.
        </td>
    </tr>
    <tr>
        <td class="th" colspan="2">
            Format settings
        </td>
    </tr>
    <tr>
        <td>
            Order referrer
        </td>
        <td>
            Choose the order referrer that should be assigned during the order import.
        </td>
    </tr>
    <tr>
        <td>
            VAT note
        </td>
        <td>
            This option is not relevant for this format.
        </td>
    </tr>
</table>

## 2 Overview of available columns

<table>
    <tr>
        <th>
            Column description
        </th>
        <th>
            Explanation
        </th>
    </tr>
    <tr>
        <td>
            article_id
        </td>
        <td>
            The <b>ID of the item</b>.
        </td>
    </tr>
    <tr>
        <td>
            deeplink
        </td>
        <td>
        	The product URL according to the format setting <b>product URL</b>, <b>Client</b> and <b>Order referrer</b>.
        </td>
    </tr>
    <tr>
        <td>
            name
        </td>
        <td>
            According the format setting <b>Item name</b>.
        </td>
    </tr>
    <tr>
		<td>
			short_description
		</td>
		<td>
			The <b>preview description</b> of the item depending on the format setting <b>Preview text</b>.
		</td>
	</tr>
    <tr>
		<td>
			description
		</td>
		<td>
			The <b>description</b> of the item depending on the format setting <b>Description</b>.
		</td>
	</tr>
    <tr>
        <td>
            article_no
        </td>
        <td>
            The <b>variation number</b>. 
        </td>
    </tr>
    <tr>
        <td>
            producer
        </td>
        <td>
            The <b>name of the manufacturer</b> of the item. The <b>external name</b> within the menu <b>Settings » Items » Manufacturer</b> will be preferred if existing.
        </td>
    </tr>
    <tr>
        <td>
            model
        </td>
        <td>
            The <b>model</b> saved under <b>Items » Edit item » Open item » Open variation » Settings » Basic Settings</b>.
        </td>
    </tr>
    <tr>
        <td>
            availabilty
        </td>
        <td>
            The <b>name of the availabilty</b> saved under <b>Settings » Items » Item availabilty</b> or according to the format setting <b>Override item availability</b>.
        </td>
    </tr>
    <tr>
        <td>
            ean
        </td>
        <td>
            According to the format setting <b>Barcode</b>.
        </td>
    </tr>
    <tr>
        <td>
            isbn
        </td>
        <td>
            According to the format setting <b>Barcode</b>.
        </td>
    </tr>
    <tr>
		<td>
			unit
		</td>
		<td>
			The <b>unit</b> of the evaluated <b>base price information</b>.
		</td>
	</tr>
	<tr>
		<td>
			price
		</td>
		<td>
			The <b>retail price</b> of the variation, according to the format setting <b>Order referrer</b>.
		</td>
	</tr>
	<tr>
		<td>
			price_old
		</td>
		<td>
			The <b>recommended retail price</b> of the variation, according to the format setting <b>Order referrer</b>.
		</td>
	</tr>
	<tr>
    	<td>
    		weight
    	</td>
    	<td>
    		The <b>weight</b> of the variation.
    	</td>
    </tr>
    <tr>
    	<td>
    		category1
    	</td>
    	<td>
    		The <b>first category level of the default category</b> for the configured <b>client</b> in the format settings.
    	</td>
    </tr>
    <tr>
    	<td>
    		category2
    	</td>
    	<td>
    		The <b>second category level of the default category</b> for the configured <b>client</b> in the format settings.
    	</td>
    </tr>
    <tr>
    	<td>
    		category3
    	</td>
    	<td>
    		The <b>third category level of the default category</b> for the configured <b>client</b> in the format settings.
    	</td>
    </tr>
    <tr>
    	<td>
    		category4
    	</td>
    	<td>
    		The <b>fourth category level of the default category</b> for the configured <b>client</b> in the format settings.
    	</td>
    </tr>
    <tr>
    	<td>
    		category5
    	</td>
    	<td>
    		The <b>fifth category level of the default category</b> for the configured <b>client</b> in the format settings.
    	</td>
    </tr>
    <tr>
    	<td>
    		category6
    	</td>
    	<td>
    		The <b>sixth category level of the default category</b> for the configured <b>client</b> in the format settings.
    	</td>
    </tr>
    <tr>
    	<td>
    		category_concat
    	</td>
    	<td>
    		The <b>category path of the default category</b> for the configured <b>client</b> in the format settings.
    	</td>
    </tr>
    <tr>
    	<td>
    		image_url_preview
    	</td>
    	<td>
    		The <b>preview image</b> of the first image of the variation.
    	</td>
    </tr>
    <tr>
    	<td>
    		image_url
    	</td>
    	<td>
    		The <b>image</b> of the first image of the variation.
    	</td>
    </tr>
    <tr>
        <td>
            shipment_and_handling
        </td>
        <td>
            For the item configured <b>shipping costs</b>.
        </td>
    </tr>
    <tr>
		<td>
			unit_price
		</td>
		<td>
			The <b>base price</b> in the format "price / unit". (e.g.: 10.00 EUR / kilogram)
		</td>
	</tr>
	<tr>
    	<td>
    		unit_price_value
    	</td>
    	<td>
    		The <b>price</b> of the evaluated <b>base price information</b>.
    	</td>
    </tr>
    <tr>
    	<td>
    		unit_price_lot
    	</td>
    	<td>
    		The <b>content</b> of the evaluated <b>base price information</b>.
    	</td>
    </tr>
    <tr>
    	<td>
    		variation_id
    	</td>
    	<td>
    		The <b>variation ID</b>.
    	</td>
    </tr>
</table>

## 3 Licence

This project is licensed under the GNU AFFERO GENERAL PUBLIC LICENSE.- find further information in the [LICENSE.md](https://github.com/plentymarkets/plugin-elastic-export-basic-price-search-engine/blob/master/LICENSE.md).
