# User Guide für das ElasticExportBasicPriceSearchEngine Plugin

<div class="container-toc"></div>

## 1 Elastic Export Basic Price Search Engine-Plugin in plentymarkets einrichten

Um dieses Format nutzen zu können, benötigen Sie das Plugin Elastic Export.

Auf der Handbuchseite [Datenformate für Preissuchmaschinen exportieren](https://knowledge.plentymarkets.com/basics/datenaustausch/daten-exportieren#30) werden die einzelnen Formateinstellungen beschrieben.

In der folgenden Tabelle finden Sie spezifische Hinweise zu den Einstellungen, Formateinstellungen und empfohlenen Artikelfiltern für das Format **BasicPriceSearchEngine-Plugin**.
<table>
    <tr>
        <th>
            Einstellung
        </th>
        <th>
            Erläuterung
        </th>
    </tr>
    <tr>
        <td class="th" colspan="2">
            Einstellungen
        </td>
    </tr>
    <tr>
        <td>
            Format
        </td>
        <td>
            <b>BasicPriceSearchEngine-Plugin</b> wählen.
        </td>
    </tr>
    <tr>
        <td>
            Bereitstellung
        </td>
        <td>
            <b>URL</b> wählen.
        </td>
    </tr>
    <tr>
        <td>
            Dateiname
        </td>
        <td>
            Der Dateiname muss auf <b>.csv</b> oder <b>.txt</b> enden, damit ein Preisportal oder eine vergleichbare Schnittstelle die Datei erfolgreich importieren kann.
        </td>
    </tr>
    <tr>
        <td class="th" colspan="2">
            Artikelfilter
        </td>
    </tr>
    <tr>
        <td>
            Aktiv
        </td>
        <td>
            <b>Aktiv</b> wählen.
        </td>
    </tr>
    <tr>
        <td>
            Märkte
        </td>
        <td>
            Eine oder mehrere Auftragsherkünfte wählen. Die gewählten Auftragsherkünfte müssen an der Variante aktiviert sein, damit der Artikel exportiert wird.
        </td>
    </tr>
    <tr>
        <td class="th" colspan="2">
            Formateinstellungen
        </td>
    </tr>
    <tr>
        <td>
            Auftragsherkunft
        </td>
        <td>
            Die Auftragsherkunft wählen, die beim Auftragsimport zugeordnet werden soll.
        </td>
    </tr>
    <tr>
        <td>
            MwSt.-Hinweis
        </td>
        <td>
            Diese Option ist für dieses Format nicht relevant.
        </td>
    </tr>
</table>

## 2 Übersicht der verfügbaren Spalten

<table>
    <tr>
        <th>
            Spaltenbezeichnung
        </th>
        <th>
            Erläuterung
        </th>
    </tr>
    <tr>
        <td>
            article_id
        </td>
        <td>
            <b>Inhalt:</b> Die <b>ID des Artikels</b>.
        </td>
    </tr>
    <tr>
        <td>
            deeplink
        </td>
        <td>
            <b>Inhalt:</b> Der <b>URL-Pfad</b> des Artikels abhängig von den Formateinstellungen <b>Mandant</b>, <b>Produkt-URL</b> und <b>Auftragsherkunft</b>.
        </td>
    </tr>
    <tr>
        <td>
            name
        </td>
        <td>
            <b>Inhalt:</b> Entsprechend der Formateinstellung <b>Artikelname</b>.
        </td>
    </tr>
    <tr>
		<td>
			short_description
		</td>
		<td>
			<b>Inhalt:</b> Entsprechend der Formateinstellung <b>Vorschautext</b>.
		</td>
	</tr>
    <tr>
		<td>
			description
		</td>
		<td>
			<b>Inhalt:</b> Entsprechend der Formateinstellung <b>Beschreibung</b>.
		</td>
	</tr>
    <tr>
        <td>
            article_no
        </td>
        <td>
            <b>Inhalt:</b> Die <b>Variantennummer</b>. 
        </td>
    </tr>
    <tr>
        <td>
            producer
        </td>
        <td>
            <b>Inhalt:</b> Der <b>Herstellers</b> des Artikels. Der <b>Externe Name</b> unter <b>Einstellungen » Artikel » Hersteller</b> wird bevorzugt, wenn vorhanden.
        </td>
    </tr>
    <tr>
        <td>
            model
        </td>
        <td>
            <b>Inhalt:</b> Das <b>Modell</b> unter <b>Artikel » Artikel bearbeiten » Artikel öffnen » Variante öffnen » Einstellungen » Grundeinstellungen</b>.
        </td>
    </tr>
    <tr>
        <td>
            availabilty
        </td>
        <td>
            <b>Inhalt:</b> Der <b>Name der Artikelverfügbarkeit</b> unter <b>Einstellungen » Artikel » Artikelverfügbarkeit</b> oder die Übersetzung gemäß der Formateinstellung <b>Artikelverfügbarkeit überschreiben</b>.
        </td>
    </tr>
    <tr>
        <td>
            ean
        </td>
        <td>
            <b>Inhalt:</b> Entsprechend der Formateinstellung <b>Barcode</b>.
        </td>
    </tr>
    <tr>
        <td>
            isbn
        </td>
        <td>
            <b>Inhalt:</b> Entsprechend der Formateinstellung <b>Barcode</b>.
        </td>
    </tr>
    <tr>
        <td>
            fedas
        </td>
        <td>
            <b>Inhalt:</b> 
        </td>
    </tr>
    <tr>
		<td>
			unit
		</td>
		<td>
			<b>Inhalt:</b> Der <b>Einheit</b> aus den berechneten <b>Grundpreisinformationen</b>.
		</td>
	</tr>
	<tr>
		<td>
			price
		</td>
		<td>
			<b>Inhalt:</b> Der <b>Verkaufspreis</b> der Variante, abhängig der Formateinstellung <b>Auftragsherkunft</b>.
		</td>
	</tr>
	<tr>
		<td>
			price_old
		</td>
		<td>
			<b>Inhalt:</b> Der <b>Angebotspreis</b> der Variante, abhängig der Formateinstellung <b>Auftragsherkunft</b>.
		</td>
	</tr>
	<tr>
    	<td>
    		weight
    	</td>
    	<td>
    		<b>Inhalt:</b> Das <b>Gewicht</b> der Variante.
    	</td>
    </tr>
    <tr>
    	<td>
    		category1
    	</td>
    	<td>
    		<b>Inhalt:</b> Die <b>erste Kategorieebene der Standardkategorie</b> für den in den Formateinstellungen definierten <b>Mandanten</b>.
    	</td>
    </tr>
    <tr>
    	<td>
    		category2
    	</td>
    	<td>
    		<b>Inhalt:</b> Die <b>zweite Kategorieebene der Standardkategorie</b> für den in den Formateinstellungen definierten <b>Mandanten</b>.
    	</td>
    </tr>
    <tr>
    	<td>
    		category3
    	</td>
    	<td>
    		<b>Inhalt:</b> Die <b>dritte Kategorieebene der Standardkategorie</b> für den in den Formateinstellungen definierten <b>Mandanten</b>.
    	</td>
    </tr>
    <tr>
    	<td>
    		category4
    	</td>
    	<td>
    		<b>Inhalt:</b> Die <b>vierte Kategorieebene der Standardkategorie</b> für den in den Formateinstellungen definierten <b>Mandanten</b>.
    	</td>
    </tr>
    <tr>
    	<td>
    		category5
    	</td>
    	<td>
    		<b>Inhalt:</b> Die <b>fünfte Kategorieebene der Standardkategorie</b> für den in den Formateinstellungen definierten <b>Mandanten</b>.
    	</td>
    </tr>
    <tr>
    	<td>
    		category6
    	</td>
    	<td>
    		<b>Inhalt:</b> Die <b>sechste Kategorieebene der Standardkategorie</b> für den in den Formateinstellungen definierten <b>Mandanten</b>.
    	</td>
    </tr>
    <tr>
    	<td>
    		category_concat
    	</td>
    	<td>
    		<b>Inhalt:</b> Der <b>Kategoriepfad der Standardkategorie</b> für den in den Formateinstellungen definierten <b>Mandanten</b>.
    	</td>
    </tr>
    <tr>
    	<td>
    		image_url_preview
    	</td>
    	<td>
    		<b>Inhalt:</b> Das <b>Vorschaubild</b> des ersten Bildes der Variante.
    	</td>
    </tr>
    <tr>
    	<td>
    		image_url
    	</td>
    	<td>
    		<b>Inhalt:</b> Das <b>Bild</b> des ersten Bildes der Variante.
    	</td>
    </tr>
    <tr>
        <td>
            shipment_and_handling
        </td>
        <td>
            <b>Inhalt:</b> Die am Artikel hinterlegten <b>Versandkosten</b>.
        </td>
    </tr>
    <tr>
		<td>
			unit_price
		</td>
		<td>
			<b>Inhalt:</b> Die <b>Grundpreisinformation</b> im Format "Preis / Einheit". (Beispiel: 10.00 EUR / Kilogramm)
		</td>
	</tr>
	<tr>
    	<td>
    		unit_price_value
    	</td>
    	<td>
    		<b>Inhalt:</b> Der <b>Preis</b> aus den berechneten <b>Grundpreisinformationen</b>.
    	</td>
    </tr>
    <tr>
    	<td>
    		unit_price_lot
    	</td>
    	<td>
    		<b>Inhalt:</b> Der <b>Inhalt</b> aus den berechneten <b>Grundpreisinformationen</b>.
    	</td>
    </tr>
    <tr>
    	<td>
    		variation_id
    	</td>
    	<td>
    		<b>Inhalt:</b> Die <b>Varianten-ID</b>.
    	</td>
    </tr>
</table>

## 3 Lizenz

Das gesamte Projekt unterliegt der GNU AFFERO GENERAL PUBLIC LICENSE – weitere Informationen finden Sie in der [LICENSE.md](https://github.com/plentymarkets/plugin-elastic-export-basic-price-search-engine/blob/master/LICENSE.md).
