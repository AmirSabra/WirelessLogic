<?php
class WirelessLogic {
	
	//Function to get strings between two strings
	public function stringsBetweenTwoStrings($str, $startingWord, $endingWord)
	{
			$offset = 0;
			$result = array();
			while (($subtringStart = strpos($str, $startingWord, $offset)) !== FALSE) {
				$subtringStart = strpos($str, $startingWord, $offset);
				$subtringStart += strlen($startingWord); 
				$size = strpos($str, $endingWord, $subtringStart) - $subtringStart;
				$result[] = substr($str, $subtringStart, $size);
				$offset = $subtringStart + 1;
			}
			
			return $result; 
	}

	//Function to get the options from the website
	public function getOptions()
	{
		
		$jsonResult = array();

		$plainTextHtml = file_get_contents('https://wltest.dns-systems.net/');
		$pricingTables = $this->stringsBetweenTwoStrings($plainTextHtml, '<div class="pricing-table">', '</div> <!-- /END ALL PACKAGE -->');

		$firstPricingTable = $pricingTables[0];
		$secondPricingTable = $pricingTables[1];

		$firstTablePackageHeaders = $this->stringsBetweenTwoStrings($firstPricingTable, '<h3>', '</h3>');
		$secondTablePackageHeaders = $this->stringsBetweenTwoStrings($secondPricingTable, '<h3>', '</h3>');

		/*$firstTablePackageNames = $this->stringsBetweenTwoStrings($firstPricingTable, '<div class="package-name">', '</div>');
		$secondTablePackageNames = $this->stringsBetweenTwoStrings($secondPricingTable, '<div class="package-name">', '</div>');*/

		$firstTablePackageDescriptions = $this->stringsBetweenTwoStrings($firstPricingTable, '<div class="package-description">', '</div>');
		$secondTablePackageDescriptions = $this->stringsBetweenTwoStrings($secondPricingTable, '<div class="package-description">', '</div>');

		$firstTablePackagePrices = $this->stringsBetweenTwoStrings($firstPricingTable, '<div class="package-price">', '</div>');
		$secondTablePackagePrices = $this->stringsBetweenTwoStrings($secondPricingTable, '<div class="package-price">', '</div>');

		$secondTablePackageDiscounts = $this->stringsBetweenTwoStrings($secondPricingTable, '<p style="color: red">', '</p>');

		$counter = 0;
		for ($i = 2; $i >= 0; $i--) {
			if ($counter <= 2) {
				$jsonResult[$counter]['optionTitle'] = $secondTablePackageHeaders[$i];
				$jsonResult[$counter]['optionDescription'] = str_replace('<br>', ' ', $secondTablePackageDescriptions[$i]);
				$jsonResult[$counter]['optionPrice'] = str_replace('<span class="price-big">', '', $secondTablePackagePrices[$i]);
				$jsonResult[$counter]['optionPrice'] = str_replace('</span>', '', $jsonResult[$counter]['optionPrice']);
				$jsonResult[$counter]['optionPrice'] = str_replace('<br>', ' ', $jsonResult[$counter]['optionPrice']);
				$jsonResult[$counter]['optionPrice'] = substr($jsonResult[$counter]['optionPrice'], 0, (strpos($jsonResult[$counter]['optionPrice'], 'Year') + 4));
				$jsonResult[$counter]['optionDiscount'] = $secondTablePackageDiscounts[$i];
			}
			if ($counter == 2)  {
				$i = 2;
				$counter++;
			}
			if ($counter >= 3) {
				$jsonResult[$counter]['optionTitle'] = $firstTablePackageHeaders[$i];
				$jsonResult[$counter]['optionDescription'] = str_replace('<br>', ' ', $firstTablePackageDescriptions[$i]);
				$jsonResult[$counter]['optionPrice'] = str_replace('<span class="price-big">', '', $firstTablePackagePrices[$i]);
				$jsonResult[$counter]['optionPrice'] = str_replace('</span>', '', $jsonResult[$counter]['optionPrice']);
				$jsonResult[$counter]['optionPrice'] = str_replace('<br>', ' ', $jsonResult[$counter]['optionPrice']);
			}
			$counter++;
		}
		return json_encode($jsonResult, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
	}
}
	$wirelessLogic = new WirelessLogic();
	print_r($wirelessLogic->getOptions());
