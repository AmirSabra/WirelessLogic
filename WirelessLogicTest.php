<?php
// Include the test framework 
include_once('EnhanceTestFramework.php'); 
include_once('WirelessLogic.php'); 
// Include your classes and test fixtures - they can be in separate files, just use include() statements for them!
// Naming: By using "extends \Enhance\TestFixture" you signal that the public methods in 
// your class are tests.
class WirelessLogicTest extends \Enhance\TestFixture { 
	// SetUp 
	// Naming: The method is optional, but if present you must call it "SetUp". 
	// Usage: You can use the SetUp method to pre-configure things you want to use in all your tests. 
	public function setUp() { } 
	// TearDown 
	// Naming: The method is optional, but if present you must call it "TearDown". 
	// Usage: You can use the TearDown method to re-set things after all you tests. 
	public function tearDown() { } 
	// Test 
	// You can name tests as you like, but they must be public. 
	// All public methods other than setUp and tearDown are treated as tests.
	
	public function getOptionsTypeTest() { 
		// Arrange 
		$target = \Enhance\Core::getCodeCoverageWrapper('WirelessLogic'); 
		// Act 
		$result = $target->getOptions();
		// Assert 
		\Enhance\Assert::isString($result); 
	}
	
	public function getOptionsEqualityTest() { 
		// Arrange 
		$target = \Enhance\Core::getCodeCoverageWrapper('WirelessLogic'); 
		// Act 
		$result = $target->getOptions();
		
		$jsonTest = '[
				{
						"optionTitle": "Optimum: 24GB Data - 1 Year",
						"optionDescription": "Up to 12GB of data per year  including 480 SMS (5p \/ MB data and 4p \/ SMS thereafter)",
						"optionPrice": "£174.00 (inc. VAT) Per Year",
						"optionDiscount": "Save £17.90 on the monthly price"
				},
				{
						"optionTitle": "Standard: 12GB Data - 1 Year",
						"optionDescription": "Up to 12GB of data per year  including 420 SMS (5p \/ MB data and 4p \/ SMS thereafter)",
						"optionPrice": "£108.00 (inc. VAT) Per Year",
						"optionDiscount": "Save £11.90 on the monthly price"
				},
				{
						"optionTitle": "Basic: 6GB Data - 1 Year",
						"optionDescription": "Up to 6GB of data per year including 240 SMS (5p \/ MB data and 4p \/ SMS thereafter)",
						"optionPrice": "£66.00 (inc. VAT) Per Year",
						"optionDiscount": "Save £5.86 on the monthly price"
				},
				{
						"optionTitle": "Optimum: 2 GB Data - 12 Months",
						"optionDescription": "2GB data per month including 40 SMS (5p \/ minute and 4p \/ SMS thereafter)",
						"optionPrice": "£15.99 (inc. VAT) Per Month"
				},
				{
						"optionTitle": "Standard: 1GB Data - 12 Months",
						"optionDescription": "Up to 1 GB data per month including 35 SMS (5p \/ MB data and 4p \/ SMS thereafter)",
						"optionPrice": "£9.99 (inc. VAT) Per Month"
				},
				{
						"optionTitle": "Basic: 500MB Data - 12 Months",
						"optionDescription": "Up to 500MB of data per month including 20 SMS (5p \/ MB data and 4p \/ SMS thereafter)",
						"optionPrice": "£5.99 (inc. VAT) Per Month"
				}
		]';
		$decodedJson = json_decode($jsonTest, true);
		$encodedJson = json_encode($decodedJson, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
		// Assert 
		\Enhance\Assert::areIdentical($encodedJson, $result); 
	}
	
	public function getStringBetweenTwoStringsTypeTest() { 
		// Arrange 
		$target = \Enhance\Core::getCodeCoverageWrapper('WirelessLogic'); 
		
		// Act 
		$result = $target->stringsBetweenTwoStrings('I am a test string', 'I', 'string');
		
		// Assert 
		\Enhance\Assert::isArray($result); 
	}
	
	public function getStringBetweenTwoStringsEqualityTest() { 
		// Arrange 
		$target = \Enhance\Core::getCodeCoverageWrapper('WirelessLogic'); 
		
		// Act 
		$result = $target->stringsBetweenTwoStrings('I am a test string', 'I', 'string');
		
		// Assert 
		\Enhance\Assert::areIdentical(' am a test ', $result[0]); 
	}
}
// Run the tests 
\Enhance\Core::runTests();