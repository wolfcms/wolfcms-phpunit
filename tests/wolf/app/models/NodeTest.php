<?php

require_once 'Node.php';

/*
 * NON-STATIC TEST CALLBACK FUNCTIONS
 */

/* One param dynamic test method (NON-STATIC).
 * 
 * Used by testRegisterMethod(), test__call()
 */
function simpleDynTest($caller, $name) {
    return "Hello, $name!";
}

/* Two params dynamic test method.(NON-STATIC)
 * 
 * Used by test__call()
 */
function simpleDynTwoParamTest($caller, $name, $hello) {
    return "$hello, $name!";
}

/* One param as array dynamic test method.(NON-STATIC)
 * 
 * Used by test__call()
 */
function simpleDynArrayParamTest($caller, $params) {
    return "$params[0], $params[1]!";
}

/* Variable number of params test method.(NON-STATIC)
 * NOTE: First param will always be the calling object
 * 
 * Used by test__call()
 */
function simpleDynVariableParamTest() {
    $params = func_get_args();
    // take the caller Object from params Array, it's first
    $caller = $params[0];
    // Let the object introduce itself
    $returnStr = 'param0=' . get_class($caller) . ' instance;';
    // Iterate the rest of params
    for ($i=1; $i < count($params); $i++) {
        $returnStr .= 'param'.$i.'='.$params[$i].';';
    }
    return $returnStr;
}

/* Simplistic dynamic test method
 * with calling object context
 * 
 * Used by test__call()
 */
function simpleDynContextTest($caller, $name) {
    $objClass = get_class($caller);
    return "$objClass is greeting $name";
}

/* Simplistic dynamic test method
 * with usage of calling object context
 * on class NodeExtended which extends Node
 * 
 * Used by test__call()
 */
function simpleDynContextExtendedTest($callerObject, $name) {
    $objClass = get_class($callerObject);
    $action = $callerObject->getAction();
    return "$objClass $action $name";
}


/*
 * STATIC TEST CALLBACK FUNCTIONS
 */

/* Simplistic dynamic test method (STATIC).
 * 
 * Used by test__call()
 */
function simpleStaticDynTest($name) {
    return "Ni hao, $name!";
}


/* Simplistic dynamic test method.(STATIC)
 * 
 * Used by test__callStatic()
 */
function simpleStaticDynTwoParamTest($name, $hello) {
    return "$hello, $name!";
}

/* Simplistic dynamic test method.
 * 
 * Used by test__callStatic()
 */
function simpleStaticDynArrayParamTest($params) {
    return "$params[0], $params[1]!";
}

/* Variable number of params test method.(NON-STATIC)
 * NOTE: First param will always be the calling object
 * 
 * Used by test__callStatic()
 */
function simpleStaticDynVariableParamTest() {
    $params = func_get_args();
    $returnStr = '';
    // Iterate the params
    for ($i=0; $i < count($params); $i++) {
        $returnStr .= 'param'.$i.'='.$params[$i].';';
    }
    return $returnStr;
}

/*
 * Simple class extending Node
 * For testing purpose
 */
class NodeExtended extends Node {
    
    protected $action = 'says';
    
    public function setAction($type) {
        $this->action = $type;
    }
    
    public function getAction() {
        return $this->action;
    }
}

/**
 * Test class for Node.
 * Generated by PHPUnit on 2011-03-10 at 21:45:54.
 */
class NodeTest extends PHPUnit_Framework_TestCase {

    /**
     * @var Node
     */
    protected $object;
    
    protected $kanaromaji = array(  'いつか;itsuka',
                                    'いつか;itsuka',
                                    'いつつ;itsutsu',
                                    'いつでも;itsudemo',
                                    'いつのまにか;itsunomanika',
                                    'いつまでも;itsumademo',
                                    'いつも;itsumo',
                                    'いてん;iten',
                                    'いと;ito',
                                    'いとこ;itoko',
                                    'いとこ;itoko',
                                    'いとま;itoma',
                                    'いど;ido',
                                    'いど;ido',
                                    'いどう;idou',
                                    'いない;inai',
                                    'いなか;inaka',
                                    'いにしえ;inishie',
                                    'いぬ;inu',
                                    'いね;ine',
                                    'いねむり;inemuri',
                                    'いのち;inochi',
                                    'いのる;inoru',
                                    'いはん;ihan',
                                    'いばる;ibaru',
                                    'いふく;ifuku',
                                    'いま;ima',
                                    'いま;ima',
                                    'いまに;imani',
                                    'いまにも;imanimo',
                                    'いみ;imi',
                                    'いもうと;imouto',
                                    'いや;iya',
                                    'いやがる;iyagaru',
                                    'いよいよ;iyoiyo',
                                    'いらい;irai',
                                    'いらい;irai',
                                    'いらいら;iraira',
                                    'いらっしゃる;irassharu',
                                    'いりぐち;iriguchi',
                                    'いりょう;iryou',
                                    'いる;iru',
                                    'いる;iru',
                                    'うち;uchi',
                                    'うちあわせ;uchiawase',
                                    'うちあわせる;uchiawaseru',
                                    'うちけす;uchikesu',
                                    'うちゅう;uchuu',
                                    'うっかり;ukkari',
                                    'うったえる;uttaeru',
                                    'うつ;utsu',
                                    'うつる;utsuru',
                                    'うらむ;uramu',
                                    'うらやましい;urayamashii',
                                    'うらやむ;urayamu',
                                    'うりあげ;uriage',
                                    'うりきれ;urikire',
                                    'うりきれる;urikireru',
                                    'うりば;uriba',
                                    'うる;uru',
                                    'おなじ;onaji',
                                    'おに;oni',
                                    'おにいさん;oniisan',
                                    'おねえさん;oneesan',
                                    'おねがいします;onegaishimasu',
                                    'おのおの;onoono',
                                    'おのおの;onoono',
                                    'おはよう;ohayou',
                                    'おば;oba',
                                    'おばあさん;obaasan',
                                    'おばさん;obasan',
                                    'おひる;ohiru',
                                    'かいがい;kaigai',
                                    'かいがん;kaigan',
                                    'かいぎ;kaigi',
                                    'かいけい;kaikei',
                                    'かいけつ;kaiketsu',
                                    'かくす;kakusu',
                                    'かくだい;kakudai',
                                    'かくち;kakuchi',
                                    'かくちょう;kakuchou',
                                    'かくど;kakudo',
                                    'かくにん;kakunin',
                                    'かくべつ;kakubetsu',
                                    'かくりつ;kakuritsu',
                                    'すいせん;suisen',
                                    'すいそ;suiso',
                                    'すいちょく;suichoku',
                                    'すいてい;suitei',
                                    'すいてき;suiteki',
                                    'すいとう;suitou',
                                    'すいどう;suidou',
                                    'ちゅうがく;chuugaku',
                                    'ちゅうげん;chuugen',
                                    'てがみ;tegami',
                                    'りょうしん;ryoushin',
                                    'どうぶつえん;doubutsuen',
                                    'もくようび;mokuyoubi',
                                    'おおよろこび;ooyorokobi',
                                    'はじめて;hajimete',
                                    'わたしたち;watashitachi',
                                    'いじょう;ijou',
                                    'ならぶ;narabu',
                                    'きせつ;kisetsu',
                                    'こたえる;kotaeru',
                                    'きりん;kirin',
                                    'くび;kubi',
                                    'しわ;shiwa',
                                    'ぞう;zou',
                                    'しょうぶ;shoubu',
                                    'しょうべん;shouben',
                                    'しょうぼう;shoubou',
                                    'しょうぼうしょ;shoubousho',
                                    'しょうみ;shoumi',
                                    'しょうめい;shoumei',
                                    'しょうめん;shoumen',
                                    'じゅわき;juwaki',
                                    'じゅん;jun',
                                    'じゅんかん;junkan',
                                    'じゅんさ;junsa',
                                    'せんすい;sensui',
                                    'せんせい;sensei',
                                    'せんせい;sensei',
                                    'せんせんげつ;sensengetsu',
                                    'せんせんしゅう;sensenshuu',
                                    'せんそう;sensou',
                                    'せんぞ;senzo',
                                    'せんたく;sentaku',
                                    'せんたく;sentaku',
                                    'せんたん;sentan',
                                    'せんでん;senden',
                                    'せんとう;sentou',
                                    'せんぱい;senpai',
                                    'せんぷうき;senpuuki',
                                    'せんめん;senmen',
                                    'せんろ;senro',
                                    'ぜいかん;zeikan',
                                    'おっしゃる;ossharu',
                                    'むすび;musubi',
                                    'いや;iya',
                                    'おもい;omoi',
                                    'リュック・サック;ryukku_sakku',
                                    'おやつ;oyatsu',
                                    'デザート;dezaato',
                                    'せんべい;senbei',
                                    'あまい;amai',
                                    'がんねん;gannen',
                                    'たす;tasu',
                                    'とし;toshi',
                                    'ごぞんじです;gozonjidesu',
                                    'どなたか;donataka',
                                    'アップライト・ピアノ;appuraito_piano',
                                    'グランド・ピアノ;gurando_piano',
                                    'がいこくせい;gaikokusei',
                                    'こくさん;kokusan',
                                    'くろい;kuroi',
                                    'ちゃいろ;chairo',
                                    'ひつよう;hitsuyou',
                                    'こうかんできる;koukandekiru',
                                    'アクセント;akusento',
                                    'かわむら;kawamura',
                                    'こうし;koushi',
                                    'える;eru',
                                    'ぶれひとげき;burehitogeki',
                                    'かのじょ;kanojo',
                                    'それん(=そびえとしゃかいしゅぎきょうわこくれんぽう);soren-sobietoshakaishugikyouwakokurenpou',
                                    'ぎきょく;gikyoku',
                                    'ブレヒトのぎきょく;burehitonogikyoku',
                                    'さくひん;sakuhin',
                                    'かんしょう;kanshou',
                                    'かんしょうする;kanshousuru',
                                    'ごちそうさまでした;gochisousamadeshita',
                                    'おじゃまします;ojamashimasu',
                                    'いらっしゃい;irasshai',
                                    'いらっしゃいませ;irasshaimase',
                                    'どうぞ、こちらへ;douzo_kochirahe',
                                    'どうぞおかけください;douzookakekudasai',
                                    'なんで;nande',
                                    'よく;yoku',
                                    'おきて;okite',
                                    'ぜんたいで;zentaide',
                                    'へいほうキロメートル;heihoukiromeetoru',
                                    'かい;kai',
                                    'キロ;kiro',
                                    'おりる;oriru',
                                    'ねる;neru',
                                    'でる;deru',
                                    'ばんごはん;bangohan',
                                    'ちか;chika',
                                    'ちかてつ;chikatetsu',
                                    'しょくどう;shokudou',
                                    'ろうか;rouka',
                                    'いりぐち;iriguchi',
                                    'すし;sushi',
                                    'ちゅっちょうりょこう;chucchouryokou',
                                    'きっぷ;kippu',
                                    'しれとこはんとう;shiretokohantou',
                                    'ほだか;hodaka',
                                    'のりくら;norikura',
                                    'みなみアルプス;minamiarupusu',
                                    'きただけ;kitadake',
                                    'しょうなんかいがん;shounankaigan',
                                    'じょうもんぶんか;joumonbunka',
                                    'やよいぶんか;yayoibunka',
                                    'こふんぶんか;kofunbunka',
                                    'あすかじだい;asukajidai',
                                    'ならじだい;narajidai',
                                    'しせいせいど;shiseiseido',
                                    'しょうとくたいし;shoutokutaishi',
                                    'ほうりゅうじ;houryuuji',
                                    'たいかのかいしん;taikanokaishin',
                                    'じんしんのらん;jinshinnoran',
                                    'とき;toki',
                                    'あいだ;aida',
                                    'さびしい;sabishii',
                                    'をのぼる;wonoboru',
                                    'そびえとしゃかいしゅぎきょうわこくれんぽう;sobietoshakaishugikyouwakokurenpou',
                                    'ふけんこう;fukenkou');

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new Node();
        $this->objectExtended = new NodeExtended();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        $this->object = null;
        $this->objectExtended = null;
    }
    
    /**
     * @covers Node::__call
     * 
     * @todo test more cases
     * 
     * We don't expect any exceptions here
     */
    public function test__call() {
        
        $this->assertTrue(method_exists('Node', 'registerMethod'));        
        
        //--------
        // ONE parameter
        $registered = Node::registerMethod('oneParamMethod', 'simpleDynTest');
        $this->assertTrue($registered);
        
            $expected = 'Hello, Martijn!';
            $actual = $this->object->oneParamMethod('Martijn');        
            $this->assertEquals($expected, $actual);
        
        //--------
        // TWO parameters
        $registered = Node::registerMethod('twoParamMethod', 'simpleDynTwoParamTest');
        $this->assertTrue($registered);
        
            $expected = 'Konichiwa, Martijn!';
            $actual = $this->object->twoParamMethod('Martijn', 'Konichiwa');
            $this->assertEquals($expected, $actual);

        //--------
        // ONE parameter as Array
        $registered = Node::registerMethod('oneParamArrayMethod', 'simpleDynArrayParamTest');
        $this->assertTrue($registered);
        
            $expected = 'Hi, guy!';
            $actual = $this->object->oneParamArrayMethod(array('Hi', 'guy'));
            $this->assertEquals($expected, $actual);
        
        //--------
        // VARIABLE number of parameters
        // currently only integers and strings tested
        $registered = Node::registerMethod('variableParamsMethod', 'simpleDynVariableParamTest');
        $this->assertTrue($registered);
        
            // strings 
            $expected = 'param0=Node instance;param1=test;param2=THIS;param3=Method;';
            $actual = $this->object->variableParamsMethod('test','THIS','Method');
            $this->assertEquals($expected, $actual);

            // integers
            $expected = 'param0=Node instance;param1=128;param2=256;param3=384;param4=512;param5=1000;';
            $actual = $this->object->variableParamsMethod(128,256,384,512,1000);
            $this->assertEquals($expected, $actual);

            // no user-passed params
            $expected = 'param0=Node instance;';
            $actual = $this->object->variableParamsMethod();
            $this->assertEquals($expected, $actual);

            // mixed params on NodeExtended instance
            $expected = 'param0=NodeExtended instance;param1=10;param2=wolves;';
            $actual = $this->objectExtended->variableParamsMethod(10,'wolves');
            $this->assertEquals($expected, $actual);

        //--------
        // dynamic test - ONE parameter with object context
        $registered = Node::registerMethod('greet', 'simpleDynContextTest');
        $this->assertTrue($registered);
        
            $expected = 'Node is greeting PHPUnit';
            $actual = $this->object->greet('PHPUnit');
            $this->assertEquals($expected, $actual);
        
        //--------
        // dynamic test - ONE parameter with object context
        // operating on object extending Node
        $registered = Node::registerMethod('takeAction', 'simpleDynContextExtendedTest');
        $this->assertTrue($registered);
        
            // default action
            $expected = 'NodeExtended says Hello!';
            $actual = $this->objectExtended->takeAction('Hello!');
            $this->assertEquals($expected, $actual);

            // change action
            $this->objectExtended->setAction('tests');
            $expected = 'NodeExtended tests Actions!';
            $actual = $this->objectExtended->takeAction('Actions!');
            $this->assertEquals($expected, $actual);

    }

    /**
     * @covers Node::__callStatic
     * 
     * @todo test more cases
     * 
     * We don't expect any exceptions here
     */
    public function test__callStatic() {
        
        $this->assertTrue(method_exists('Node', 'registerMethod'));
        
        //--------
        // ONE parameter
        $result = Node::registerMethod('oneParamStatMethod', 'simpleStaticDynTest', true);
        $this->assertTrue($result);
        
            $expected = 'Ni hao, Martijn!';
            $actual = Node::oneParamStatMethod('Martijn');
            $this->assertEquals($expected, $actual);
        
        //--------
        // TWO parameters
        $result = Node::registerMethod('twoParamStatMethod', 'simpleStaticDynTwoParamTest', true);
        $this->assertTrue($result);
        
            $expected = 'Konichiwa, Martijn!';
            $actual = Node::twoParamStatMethod('Martijn', 'Konichiwa');
            $this->assertEquals($expected, $actual);      
        
        //--------
        // ONE parameter as Array
        $registered = Node::registerMethod('someNewStatArrayMethod', 'simpleStaticDynArrayParamTest',true);
        $this->assertTrue($registered);
        
            $expected = 'Hi, guy!';
            $actual = Node::someNewStatArrayMethod(array('Hi', 'guy'));
            $this->assertEquals($expected, $actual);        
        
        //--------
        // VARIABLE number of parameters
        // currently only integers and strings tested
        $registered = Node::registerMethod('variableParamsStaticMethod', 'simpleStaticDynVariableParamTest',true);
        $this->assertTrue($registered);        
        
            // strings 
            $expected = 'param0=test;param1=THIS;param2=Method;';
            $actual = Node::variableParamsStaticMethod('test','THIS','Method');
            $this->assertEquals($expected, $actual);

            // integers
            $expected = 'param0=128;param1=256;param2=384;param3=512;param4=1000;';
            $actual = Node::variableParamsStaticMethod(128,256,384,512,1000);
            $this->assertEquals($expected, $actual);

            // no user-passed params
            $expected = '';
            $actual = Node::variableParamsStaticMethod();
            $this->assertEquals($expected, $actual);

            // mixed params invoked on NodeExtended class
            $expected = 'param0=10;param1=wolves;';
            $actual = NodeExtended::variableParamsStaticMethod(10,'wolves');
            $this->assertEquals($expected, $actual);        
    }

    /**
     * @covers Node::registerMethod
     * 
     * We don't expect any exceptions here
     */
    public function testRegisterMethod() {
        
        $this->assertTrue(method_exists('Node', 'registerMethod'));
        
        //--------
        // register dynamic method for valid (existing) function
        $result = Node::registerMethod('someMethod', 'simpleDynTest');
        $this->assertTrue($result);
        
        //--------
        // register static method for valid (existing) function
        $result = Node::registerMethod('someStatMethod', 'simpleStaticDynTest', true);
        $this->assertTrue($result);        
    }
    
    /**
     * Non-existing callback test
     * We expect InvalidArgumentException to be raised
     * 
     * @covers Node::registerMethod
     * 
     * @expectedException InvalidArgumentException
     */
    public function testRegisterMethod_NonExistingCallback() {
        Node::registerMethod('someExcMethod', 'nonExistingCallback');
    }
    
    /**
     * Duplicate name Exception test (NON-STATIC)
     * We expect InvalidArgumentException to be raised
     * 
     * @covers Node::registerMethod
     * 
     * @expectedException InvalidArgumentException
     */
    public function testRegisterMethod_DuplicateName() {
        $registered = Node::registerMethod('uniqueMethod', 'simpleStaticDynTest');
        $this->assertTrue($registered);
        Node::registerMethod('uniqueMethod', 'simpleStaticDynTest'); // throw!!!
    }
    
    /**
     * Duplicate name Exception test (STATIC)
     * We expect InvalidArgumentException to be raised
     * 
     * @covers Node::registerMethod
     * 
     * @expectedException InvalidArgumentException
     */
    public function testRegisterMethod_DuplicateNameStatic() {
        $registered = Node::registerMethod('uniqueStaticMethod', 'simpleStaticDynTest', true);
        $this->assertTrue($registered);
        Node::registerMethod('uniqueStaticMethod', 'simpleStaticDynTest', true); // throw!!!
    }

    /**
     * @covers Node::toSlug
     */
    public function testToSlug() {
        // Remove the following lines when you implement this test.
        $this->assertEquals("this-is-a-slug-test", Node::toSlug("This is a slug test"));
        $this->assertEquals("this-is-a-slug-test", Node::toSlug("This IS  a slug-test"));
        $this->assertEquals("this-is-a-2nd-slug-test-part-two", Node::toSlug("This IS  a 2nd slug---test part-two"));
        $this->assertEquals("this-is-another-slug_test", Node::toSlug("This is another, slug_test"));
        $this->assertEquals("konnichiha", Node::toSlug('こんにちは'));
        $this->assertEquals("aa-a-ae-a-ae-oe-o", Node::toSlug("å Å ä Ä ä ö Ö"));
      
        $line = 1;

        foreach($this->kanaromaji as $test){
            list($jap,$rom) = explode(';',trim($test));

            $chk = Node::toSlug($jap);
            $this->assertEquals($chk,$rom);
            $line++;
        }
    }
    
}

?>
