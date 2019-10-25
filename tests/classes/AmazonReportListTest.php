<?php
use robertbennettuk\AmazonMws\AmazonReportList;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2012-12-12 at 13:17:14.
 */
class AmazonReportListTest extends PHPUnit_Framework_TestCase {

    /**
     * @var AmazonReportList
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        resetLog();
        $this->object = new AmazonReportList('testStore', true, null);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }
    
    public function testSetUseToken(){
        $this->assertNull($this->object->setUseToken());
        $this->assertNull($this->object->setUseToken(true));
        $this->assertNull($this->object->setUseToken(false));
        $this->assertFalse($this->object->setUseToken('wrong'));
    }
    
    public function testSetRequestIds(){
        $this->assertFalse($this->object->setRequestIds(null)); //can't be nothing
        $this->assertFalse($this->object->setRequestIds(5)); //can't be an int
        
        $list = array('One','Two','Three');
        $this->assertNull($this->object->setRequestIds($list));
        
        $o = $this->object->getOptions();
        $this->assertArrayHasKey('ReportRequestIdList.Id.1',$o);
        $this->assertEquals('One',$o['ReportRequestIdList.Id.1']);
        $this->assertArrayHasKey('ReportRequestIdList.Id.2',$o);
        $this->assertEquals('Two',$o['ReportRequestIdList.Id.2']);
        $this->assertArrayHasKey('ReportRequestIdList.Id.3',$o);
        $this->assertEquals('Three',$o['ReportRequestIdList.Id.3']);
        
        $this->assertNull($this->object->setRequestIds('Four')); //will cause reset
        $o2 = $this->object->getOptions();
        $this->assertArrayHasKey('ReportRequestIdList.Id.1',$o2);
        $this->assertEquals('Four',$o2['ReportRequestIdList.Id.1']);
        $this->assertArrayNotHasKey('ReportRequestIdList.Id.2',$o2);
        $this->assertArrayNotHasKey('ReportRequestIdList.Id.3',$o2);
        
        $this->object->resetRequestIds();
        $o3 = $this->object->getOptions();
        $this->assertArrayNotHasKey('ReportRequestIdList.Id.1',$o3);
    }
    
    public function testSetReportTypes(){
        $this->assertFalse($this->object->setReportTypes(null)); //can't be nothing
        $this->assertFalse($this->object->setReportTypes(5)); //can't be an int
        
        $list = array('One','Two','Three');
        $this->assertNull($this->object->setReportTypes($list));
        
        $o = $this->object->getOptions();
        $this->assertArrayHasKey('ReportTypeList.Type.1',$o);
        $this->assertEquals('One',$o['ReportTypeList.Type.1']);
        $this->assertArrayHasKey('ReportTypeList.Type.2',$o);
        $this->assertEquals('Two',$o['ReportTypeList.Type.2']);
        $this->assertArrayHasKey('ReportTypeList.Type.3',$o);
        $this->assertEquals('Three',$o['ReportTypeList.Type.3']);
        
        $this->assertNull($this->object->setReportTypes('Four')); //will cause reset
        $o2 = $this->object->getOptions();
        $this->assertArrayHasKey('ReportTypeList.Type.1',$o2);
        $this->assertEquals('Four',$o2['ReportTypeList.Type.1']);
        $this->assertArrayNotHasKey('ReportTypeList.Type.2',$o2);
        $this->assertArrayNotHasKey('ReportTypeList.Type.3',$o2);
        
        $this->object->resetReportTypes();
        $o3 = $this->object->getOptions();
        $this->assertArrayNotHasKey('ReportTypeList.Type.1',$o3);
    }
    
    public function testSetMaxCount(){
        $this->assertFalse($this->object->setMaxCount(null)); //can't be nothing
        $this->assertFalse($this->object->setMaxCount(9.75)); //can't be decimal
        $this->assertFalse($this->object->setMaxCount('75')); //can't be a string
        $this->assertFalse($this->object->setMaxCount(array(5,7))); //not a valid value
        $this->assertFalse($this->object->setMaxCount('banana')); //what are you even doing
        $this->assertNull($this->object->setMaxCount(77));
        $o = $this->object->getOptions();
        $this->assertArrayHasKey('MaxCount',$o);
        $this->assertEquals(77,$o['MaxCount']);
    }
    
    public function testSetAcknowledgedFilter(){
        $this->assertFalse($this->object->setAcknowledgedFilter(5)); //can't be an int
        $this->assertFalse($this->object->setAcknowledgedFilter('banana')); //can't be a random word
        $this->assertNull($this->object->setAcknowledgedFilter(false));
        $this->assertNull($this->object->setAcknowledgedFilter(true));
        $this->assertNull($this->object->setAcknowledgedFilter('false'));
        $this->assertNull($this->object->setAcknowledgedFilter('true'));
        $o = $this->object->getOptions();
        $this->assertArrayHasKey('Acknowledged',$o);
        $this->assertEquals('true',$o['Acknowledged']);
        $this->assertNull($this->object->setAcknowledgedFilter(null)); //reset
        $o2 = $this->object->getOptions();
        $this->assertArrayNotHasKey('Acknowledged',$o2);
    }
    
    /**
    * @return array
    */
    public function timeProvider() {
        return array(
            array(null, null, false, false), //nothing given, so no change
            array(true, true, false, false), //not strings or numbers
            array('', '', false, false), //strings, but empty
            array('-1 min', null, true, false), //one set
            array(null, '-1 min', false, true), //other set
            array('-1 min', '-1 min', true, true), //both set
        );
    }
    
    /**
     * @dataProvider timeProvider
     */
    public function testSetTimeLimits($a, $b, $c, $d){
        $this->object->setTimeLimits($a,$b);
        $o = $this->object->getOptions();
        if ($c){
            $this->assertArrayHasKey('AvailableFromDate',$o);
            $this->assertStringMatchesFormat('%d-%d-%dT%d:%d:%d%i',$o['AvailableFromDate']);
        } else {
            $this->assertArrayNotHasKey('AvailableFromDate',$o);
        }
        
        if ($d){
            $this->assertArrayHasKey('AvailableToDate',$o);
            $this->assertStringMatchesFormat('%d-%d-%dT%d:%d:%d%i',$o['AvailableToDate']);
        } else {
            $this->assertArrayNotHasKey('AvailableToDate',$o);
        }
    }
    
    public function testResetTimeLimit(){
        $this->object->setTimeLimits('-1 min','-1 min');
        $o = $this->object->getOptions();
        $this->assertArrayHasKey('AvailableFromDate',$o);
        $this->assertArrayHasKey('AvailableToDate',$o);
        
        $this->object->resetTimeLimits();
        $check = $this->object->getOptions();
        $this->assertArrayNotHasKey('AvailableFromDate',$check);
        $this->assertArrayNotHasKey('AvailableToDate',$check);
    }
    
    public function testFetchReportList(){
        resetLog();
        $this->object->setMock(true,'fetchReportList.xml'); //no token
        $this->assertNull($this->object->fetchReportList());
        
        $o = $this->object->getOptions();
        $this->assertEquals('GetReportList',$o['Action']);
        
        $check = parseLog();
        $this->assertEquals('Single Mock File set: fetchReportList.xml',$check[1]);
        $this->assertEquals('Fetched Mock File: mock/fetchReportList.xml',$check[2]);
        
        $this->assertFalse($this->object->hasToken());
        
        return $this->object;
    }
    
    public function testFetchReportListToken1(){
        resetLog();
        $this->object->setMock(true,'fetchReportListToken.xml'); //no token
        
        //without using token
        $this->assertNull($this->object->fetchReportList());
        $check = parseLog();
        $this->assertEquals('Single Mock File set: fetchReportListToken.xml',$check[1]);
        $this->assertEquals('Fetched Mock File: mock/fetchReportListToken.xml',$check[2]);
        
        $this->assertTrue($this->object->hasToken());
        $o = $this->object->getOptions();
        $this->assertEquals('GetReportList',$o['Action']);
        $r = $this->object->getList();
        $this->assertArrayHasKey(0,$r);
        $this->assertEquals(1,count($r));
        $this->assertInternalType('array',$r[0]);
        $this->assertArrayNotHasKey(1,$r);
    }
    
    public function testFetchReportListToken2(){
        resetLog();
        $this->object->setMock(true,array('fetchReportListToken.xml','fetchReportListToken2.xml'));
        
        //with using token
        $this->object->setUseToken();
        $this->assertNull($this->object->fetchReportList());
        $check = parseLog();
        $this->assertEquals('Mock files array set.',$check[1]);
        $this->assertEquals('Fetched Mock File: mock/fetchReportListToken.xml',$check[2]);
        $this->assertEquals('Recursively fetching more Reports',$check[3]);
        $this->assertEquals('Fetched Mock File: mock/fetchReportListToken2.xml',$check[4]);
        $this->assertFalse($this->object->hasToken());
        $o = $this->object->getOptions();
        $this->assertEquals('GetReportListByNextToken',$o['Action']);
        $r = $this->object->getList();
        $this->assertArrayHasKey(0,$r);
        $this->assertArrayHasKey(1,$r);
        $this->assertEquals(2,count($r));
        $this->assertInternalType('array',$r[0]);
        $this->assertInternalType('array',$r[1]);
        $this->assertNotEquals($r[0],$r[1]);
    }
    
    /**
     * @depends testFetchReportList
     */
    public function testGetReportId($o){
        $get = $o->getReportId(0);
        $this->assertEquals('898899473',$get);
        
        $this->assertFalse($o->getReportId('wrong')); //not number
        $this->assertFalse($this->object->getReportId()); //not fetched yet for this object
    }
    
    /**
     * @depends testFetchReportList
     */
    public function testGetReportType($o){
        $get = $o->getReportType(0);
        $this->assertEquals('_GET_MERCHANT_LISTINGS_DATA_',$get);
        
        $this->assertFalse($o->getReportType('wrong')); //not number
        $this->assertFalse($this->object->getReportType()); //not fetched yet for this object
    }
    
    /**
     * @depends testFetchReportList
     */
    public function testGetReportRequestId($o){
        $get = $o->getReportRequestId(0);
        $this->assertEquals('2278662938',$get);
        
        $this->assertFalse($o->getReportRequestId('wrong')); //not number
        $this->assertFalse($this->object->getReportRequestId()); //not fetched yet for this object
    }
    
    /**
     * @depends testFetchReportList
     */
    public function testGetAvailableDate($o){
        $get = $o->getAvailableDate(0);
        $this->assertEquals('2009-02-10T09:22:33+00:00',$get);
        
        $this->assertFalse($o->getAvailableDate('wrong')); //not number
        $this->assertFalse($this->object->getAvailableDate()); //not fetched yet for this object
    }
    
    /**
     * @depends testFetchReportList
     */
    public function testGetIsAcknowledged($o){
        $get = $o->getIsAcknowledged(0);
        $this->assertEquals('false',$get);
        
        $this->assertFalse($o->getIsAcknowledged('wrong')); //not number
        $this->assertFalse($this->object->getIsAcknowledged()); //not fetched yet for this object
    }
    
    /**
     * @depends testFetchReportList
     */
    public function testGetList($o){
        $x = array();
        $x1 = array();
        $x1['ReportId'] = '898899473';
        $x1['ReportType'] = '_GET_MERCHANT_LISTINGS_DATA_';
        $x1['ReportRequestId'] = '2278662938';
        $x1['AvailableDate'] = '2009-02-10T09:22:33+00:00';
        $x1['Acknowledged'] = 'false';
        $x[0] = $x1;
        
        $this->assertEquals($x,$o->getList());
        $this->assertEquals($x1,$o->getList(0));
        
        $this->assertFalse($this->object->getList()); //not fetched yet for this object
    }
    
    public function testFetchCount(){
        resetLog();
        $this->object->setRequestIds('123456');
        $this->object->setMaxCount(77);
        $this->object->setMock(true,'fetchReportCount.xml');
        $this->assertNull($this->object->fetchCount());
        
        $o = $this->object->getOptions();
        $this->assertEquals('GetReportCount',$o['Action']);
        $this->assertArrayNotHasKey('ReportRequestIdList.Id.1',$o);
        $this->assertArrayNotHasKey('MaxCount',$o);
        
        $check = parseLog();
        $this->assertEquals('Single Mock File set: fetchReportCount.xml',$check[1]);
        $this->assertEquals('Fetched Mock File: mock/fetchReportCount.xml',$check[2]);
        
        $this->assertFalse($this->object->hasToken());
        
        return $this->object;
    }
    
    /**
     * @depends testFetchCount
     */
    public function testGetCount($o){
        $get = $o->getCount();
        $this->assertEquals('166',$get);
        
        $this->assertFalse($this->object->getCount()); //not fetched yet for this object
    }
    
}

require_once(__DIR__.'/../helperFunctions.php');