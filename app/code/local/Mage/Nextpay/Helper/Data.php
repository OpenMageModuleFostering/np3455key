<?php
class Mage_Nextpay_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * Get current extension environment
     *
     * @return int
     */
    public function getMode() {
        $configMode = Mage::getStoreConfig('payment/nextpay/test_mode');
        return $configMode;
    }

    public function getGatewayUrl() {
        $configMode = Mage::getStoreConfig('payment/nextpay/test_mode');

        $gateway_url = "https://gateway.nextpay.com/interface/process.do";
        if ($configMode) {
            $gateway_url = "https://gateway.nextpay.com/testing/process.do";
        }

        return $gateway_url;
    }

    public function getRedirectUrl() {
        return Mage::getUrl('nextpay/index/index', array('_secure' => true));
    }
    
    public function getReturnUrl() {
        return Mage::getUrl('nextpay/index/return', array('_secure' => true));
    }
    
    public function getDynamicReturnUrl() {
        return Mage::getUrl('nextpay/index/dynamicreturn', array('_secure' => true));
    }

    public function getIdCommerce() {
        return Mage::getStoreConfig('payment/nextpay/idcom');
    }

    public function getTransactionType() {
        return Mage::getStoreConfig('payment/nextpay/transaction_type');
    }
    
    public function get3DigitCountryCode($country_code) {
        $data = array(
            "AA"=>"AAA",
        "AD"=>"AND",
        "AE"=>"ARE",
        "AF"=>"AFG",
        "AG"=>"ATG",
        "AI"=>"AIA",
        "AL"=>"ALB",
        "AM"=>"ARM",
        "AN"=>"ANT",
        "AO"=>"AGO",
        "AQ"=>"ATA",
        "AR"=>"ARG",
        "AS"=>"ASM",
        "AT"=>"AUT",
        "AU"=>"AUS",
        "AW"=>"ABW",
        "AX"=>"ALA",
        "AZ"=>"AZE",
        "BA"=>"BIH",
        "BB"=>"BRB",
        "BD"=>"BGD",
        "BE"=>"BEL",
        "BF"=>"BFA",
        "BG"=>"BGR",
        "BH"=>"BHR",
        "BI"=>"BDI",
        "BJ"=>"BEN",
        "BL"=>"BLM",
        "BM"=>"BMU",
        "BN"=>"BRN",
        "BO"=>"BOL",
        "BR"=>"BRA",
        "BS"=>"BHS",
        "BT"=>"BTN",
        "BU"=>"BUR",
        "BV"=>"BVT",
        "BW"=>"BWA",
        "BY"=>"BLR",
        "BZ"=>"BLZ",
        "CA"=>"CAN",
        "CC"=>"CCK",
        "CD"=>"COD",
        "CF"=>"CAF",
        "CG"=>"COG",
        "CH"=>"CHE",
        "CI"=>"CIV",
        "CK"=>"COK",
        "CL"=>"CHL",
        "CM"=>"CMR",
        "CN"=>"CHN",
        "CO"=>"COL",
        "CR"=>"CRI",
        "CS"=>"SCG",
        "CU"=>"CUB",
        "CV"=>"CPV",
        "CX"=>"CXR",
        "CY"=>"CYP",
        "CZ"=>"CZE",
        "DD"=>"DDR",
        "DE"=>"DEU",
        "DJ"=>"DJI",
        "DK"=>"DNK",
        "DM"=>"DMA",
        "DO"=>"DOM",
        "DZ"=>"DZA",
        "EC"=>"ECU",
        "EE"=>"EST",
        "EG"=>"EGY",
        "EH"=>"ESH",
        "ER"=>"ERI",
        "ES"=>"ESP",
        "ET"=>"ETH",
        "FI"=>"FIN",
        "FJ"=>"FJI",
        "FK"=>"FLK",
        "FM"=>"FSM",
        "FO"=>"FRO",
        "FR"=>"FRA",
        "FX"=>"FXX",
        "GA"=>"GAB",
        "GB"=>"GBR",
        "GD"=>"GRD",
        "GE"=>"GEO",
        "GF"=>"GUF",
        "GG"=>"GGY",
        "GH"=>"GHA",
        "GI"=>"GIB",
        "GL"=>"GRL",
        "GM"=>"GMB",
        "GN"=>"GIN",
        "GP"=>"GLP",
        "GQ"=>"GNQ",
        "GR"=>"GRC",
        "GS"=>"SGS",
        "GT"=>"GTM",
        "GU"=>"GUM",
        "GW"=>"GNB",
        "GY"=>"GUY",
        "HK"=>"HKG",
        "HM"=>"HMD",
        "HN"=>"HND",
        "HR"=>"HRV",
        "HT"=>"HTI",
        "HU"=>"HUN",
        "ID"=>"IDN",
        "IE"=>"IRL",
        "IL"=>"ISR",
        "IM"=>"IMN",
        "IN"=>"IND",
        "IO"=>"IOT",
        "IQ"=>"IRQ",
        "IR"=>"IRN",
        "IS"=>"ISL",
        "IT"=>"ITA",
        "JE"=>"JEY",
        "JM"=>"JAM",
        "JO"=>"JOR",
        "JP"=>"JPN",
        "KE"=>"KEN",
        "KG"=>"KGZ",
        "KH"=>"KHM",
        "KI"=>"KIR",
        "KM"=>"COM",
        "KN"=>"KNA",
        "KP"=>"PRK",
        "KR"=>"KOR",
        "KW"=>"KWT",
        "KY"=>"CYM",
        "KZ"=>"KAZ",
        "LA"=>"LAO",
        "LB"=>"LBN",
        "LC"=>"LCA",
        "LI"=>"LIE",
        "LK"=>"LKA",
        "LR"=>"LBR",
        "LS"=>"LSO",
        "LT"=>"LTU",
        "LU"=>"LUX",
        "LV"=>"LVA",
        "LY"=>"LBY",
        "MA"=>"MAR",
        "MC"=>"MCO",
        "MD"=>"MDA",
        "ME"=>"MNE",
        "MG"=>"MDG",
        "MF"=>"MAF",
        "MH"=>"MHL",
        "MK"=>"MKD",
        "ML"=>"MLI",
        "MM"=>"MMR",
        "MN"=>"MNG",
        "MO"=>"MAC",
        "MP"=>"MNP",
        "MQ"=>"MTQ",
        "MR"=>"MRT",
        "MS"=>"MSR",
        "MT"=>"MLT",
        "MU"=>"MUS",
        "MV"=>"MDV",
        "MW"=>"MWI",
        "MX"=>"MEX",
        "MY"=>"MYS",
        "MZ"=>"MOZ",
        "NA"=>"NAM",
        "NC"=>"NCL",
        "NE"=>"NER",
        "NF"=>"NFK",
        "NG"=>"NGA",
        "NI"=>"NIC",
        "NL"=>"NLD",
        "NO"=>"NOR",
        "NP"=>"NPL",
        "NR"=>"NRU",
        "NT"=>"NTZ",
        "NU"=>"NIU",
        "NZ"=>"NZL",
        "OM"=>"OMN",
        "PA"=>"PAN",
        "PE"=>"PER",
        "PF"=>"PYF",
        "PG"=>"PNG",
        "PH"=>"PHL",
        "PK"=>"PAK",
        "PL"=>"POL",
        "PM"=>"SPM",
        "PN"=>"PCN",
        "PR"=>"PRI",
        "PS"=>"PSE",
        "PT"=>"PRT",
        "PW"=>"PLW",
        "PY"=>"PRY",
        "QA"=>"QAT",
        "QM"=>"QMM",
        "QN"=>"QNN",
        "QO"=>"QOO",
        "QP"=>"QPP",
        "QQ"=>"QQQ",
        "QR"=>"QRR",
        "QS"=>"QSS",
        "QT"=>"QTT",
        "QU"=>"QUU",
        "QV"=>"QVV",
        "QW"=>"QWW",
        "QX"=>"QXX",
        "QY"=>"QYY",
        "QZ"=>"QZZ",
        "RE"=>"REU",
        "RO"=>"ROU",
        "RS"=>"SRB",
        "RU"=>"RUS",
        "RW"=>"RWA",
        "SA"=>"SAU",
        "SB"=>"SLB",
        "SC"=>"SYC",
        "SD"=>"SDN",
        "SE"=>"SWE",
        "SG"=>"SGP",
        "SH"=>"SHN",
        "SI"=>"SVN",
        "SJ"=>"SJM",
        "SK"=>"SVK",
        "SL"=>"SLE",
        "SM"=>"SMR",
        "SN"=>"SEN",
        "SO"=>"SOM",
        "SR"=>"SUR",
        "ST"=>"STP",
        "SU"=>"SUN",
        "SV"=>"SLV",
        "SY"=>"SYR",
        "SZ"=>"SWZ",
        "TC"=>"TCA",
        "TD"=>"TCD",
        "TF"=>"ATF",
        "TG"=>"TGO",
        "TH"=>"THA",
        "TJ"=>"TJK",
        "TK"=>"TKL",
        "TL"=>"TLS",
        "TM"=>"TKM",
        "TN"=>"TUN",
        "TO"=>"TON",
        "TP"=>"TMP",
        "TR"=>"TUR",
        "TT"=>"TTO",
        "TV"=>"TUV",
        "TW"=>"TWN",
        "TZ"=>"TZA",
        "UA"=>"UKR",
        "UG"=>"UGA",
        "UM"=>"UMI",
        "US"=>"USA",
        "UY"=>"URY",
        "UZ"=>"UZB",
        "VA"=>"VAT",
        "VC"=>"VCT",
        "VE"=>"VEN",
        "VG"=>"VGB",
        "VI"=>"VIR",
        "VN"=>"VNM",
        "VU"=>"VUT",
        "WF"=>"WLF",
        "WS"=>"WSM",
        "XA"=>"XAA",
        "XB"=>"XBB",
        "XC"=>"XCC",
        "XD"=>"XDD",
        "XE"=>"XEE",
        "XF"=>"XFF",
        "XG"=>"XGG",
        "XH"=>"XHH",
        "XI"=>"XII",
        "XJ"=>"XJJ",
        "XK"=>"XKK",
        "XL"=>"XLL",
        "XM"=>"XMM",
        "XN"=>"XNN",
        "XO"=>"XOO",
        "XP"=>"XPP",
        "XQ"=>"XQQ",
        "XR"=>"XRR",
        "XS"=>"XSS",
        "XT"=>"XTT",
        "XU"=>"XUU",
        "XV"=>"XVV",
        "XW"=>"XWW",
        "XX"=>"XXX",
        "XY"=>"XYY",
        "XZ"=>"XZZ",
        "YD"=>"YMD",
        "YE"=>"YEM",
        "YT"=>"MYT",
        "YU"=>"YUG",
        "ZA"=>"ZAF",
        "ZM"=>"ZMB",
        "ZR"=>"ZAR",
        "ZW"=>"ZWE",
        "ZZ"=>"ZZZ"
        );
        return $data[$country_code];
    }


    /**
     * Convert price to cents.
     *
     * @param $amount
     * @return int
     */
    public function convertToCents($amount) {
        return (int) ($amount * 100);
    }
}