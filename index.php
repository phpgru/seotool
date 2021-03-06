<?php                        
//session_id( uniqid() );
session_start();
//session_regenerate_id();
error_reporting(E_ERROR);

$user = $_SESSION['user'];

include ('assets/templates/header.php');
if ($_SESSION['userEmail'] != null)
{
    $_SESSION['type'] = 'private';
    $_SESSION['logo'] == "nativerank";
    $_SESSION['user'] = $user;
    $url =  $_SESSION['url'];
    $finish =  $_SESSION['finish'];

    /**
     *   Domain Age
     */
        $getDomainAge = json_decode($_SESSION['getDomainAge'],true);

    /**
     *   Alexa Rank
     */
        $getAlexaGlobalRank =  $_SESSION['getAlexaGlobalRank'];
        // if ($getAlexaGlobalRank == 0)
        //     $getAlexaGlobalRank = 100000;


    /**
     *   Page Size
     */
        $pagesize =  $_SESSION['pagesize'];

    /**
     *   SEMRush
     */
        $getSEMRushDomainRank =  $_SESSION['getSEMRushDomainRank'];
        $getSEMRushOrganicKeywords =  $_SESSION['getSEMRushOrganicKeywords'];
        $getSEMRushPaidSearch = $_SESSION['getSEMRushPaidSearch'];
        $getSEMRushPaidSearchDomainOverview = $_SESSION['getSEMRushPaidSearchDomainOverview'];
        /**
        *   Recommended Budget from Nativerank
        */
            function setRecommendedBudget() {
                global $getSEMRushPaidSearch;
                if (count($getSEMRushPaidSearch) == 0) {
                    return;
                }   
                    
                $avgCpc = (
                    floatval($getSEMRushPaidSearch[0][1]) + 
                    floatval($getSEMRushPaidSearch[1][1]) + 
                    floatval($getSEMRushPaidSearch[2][1]) + 
                    floatval($getSEMRushPaidSearch[3][1]) + 
                    floatval($getSEMRushPaidSearch[4][1])) / 5;
                $expConv = 10;
                $convRate = 0.05;
                $recBudget = ceil(($avgCpc * ($expConv / $convRate)) / 100) * 100;
                function manFee($val) {
                    if ($val < 1499.99) {
                        return 250;
                    } else if ($val < 9999) {
                        return ceil($recBudget * 0.2);
                    } else {
                        return ceil($val * 0.15);
                    }
                }
                
                $manFee = manFee($recBudget);
                $totalCost = ceil($recBudget + $manFee);
                $recommendBudget['recommendedPPCBudget'] = $recBudget;
                $recommendBudget['monthlyPPCManageFee'] = $manFee;
                $recommendBudget['totalPPCCost'] = $totalCost;
                $_SESSION['recommendBudget'] = $recommendBudget;
            }
            
        setRecommendedBudget();

    /**
     *   WOT Reputation - get all json data  from wot api server
     */
        $getWOT = $_SESSION['getWOT'];
        if ($getWOT == null)
            $getWOT = array();
        $getWOT =  reset($getWOT);
    
        function objectToArray($d) {
            if (is_object($d)) {
                    $d = get_object_vars($d);
            }
            if (is_array($d)) {
                    return array_map(__FUNCTION__, $d);
            } else {
                // Return array
                    return $d;
            }
        }
        
        function test_reputation($rep){ 
            if($rep >= 80)return 'Excellent';
            if($rep >= 60 && $rep < 80)return 'Good';
            if($rep >= 40 && $rep < 60)return 'Unsatisfactory';
            if($rep >= 20 && $rep < 40)return 'Poor';
            if($rep > 0 && $rep < 20)return 'Very poor';
            return "not available";
        }
        
        function test_categories($cat){
            if($cat == '101')return 'Malware or viruses';
            if($cat == '102')return 'Poor customer experience';
            if($cat == '103')return 'Phishing';
            if($cat == '104')return 'Scam';
            if($cat == '105')return 'Potentially illegal';
            if($cat == '201')return 'Misleading claims or unethical';
            if($cat == '202')return 'Privacy risks';
            if($cat == '203')return 'Suspicious';
            if($cat == '204')return 'Hate, discrimination';
            if($cat == '205')return 'Spam';
            if($cat == '206')return 'Potentially unwanted programs';
            if($cat == '207')return 'Ads / pop-ups';
            if($cat == '301')return 'Online tracking';
            if($cat == '302')return 'Alternative or controversial medicine';
            if($cat == '303')return 'Opinions, religion, politics';
            if($cat == '304')return 'Other';
            if($cat == '501')return 'Good site';
            if($cat == '401')return 'Adult content';
            if($cat == '402')return 'Incidental nudity';
            if($cat == '403')return 'Gruesome or shocking';
            if($cat == '404')return 'Site for kids';
            return 'Not available';
        }


        $_0 = '0';
        $_4 = '4';

        $trustworthiness = $getWOT->$_0;
        $trustworthiness = $trustworthiness[0];
        $childsafety = $getWOT->$_4;
        $childsafety = $childsafety[0];
        $categories = $getWOT->categories;
        /*
        *   END WOT Reputation
        */

    $countImagesAltTexts = $_SESSION['countImagesAltTexts'];
    $checkTitle = $_SESSION['checkTitle'];
    $checkMetaDescription = $_SESSION['checkMetaDescription'];
    $checkMetaKeywords = $_SESSION['checkMetaKeywords'];
    $countWords = $_SESSION['countWords'];
    $getMostMeetWords = $_SESSION['getMostMeetWords'];
    $checkCleanUrls = $_SESSION['checkCleanUrls'];
    $getGoogleToolbarPageRank = $_SESSION['getGoogleToolbarPageRank'];
    $getGoogleBacklinksTotal = $_SESSION['getGoogleBacklinksTotal'];
    $getGooglePlusOnes = $_SESSION['getGooglePlusOnes'];
    $getPagespeedScore = $_SESSION['getPagespeedScore'];
    $getSiteindexTotal = $_SESSION['getSiteindexTotal'];
    $getSiteindexTotalBing = $_SESSION['getSiteindexTotalBing'];
    $getFacebookInteractions = $_SESSION['getFacebookInteractions'];
    $getTwitterMentions = $_SESSION['getTwitterMentions'];
    $hasRobots = $_SESSION['hasRobots'];
    $hasSitemaps = $_SESSION['hasSitemaps'];
    $validate =  $_SESSION['validate'];
    $getWWWResolve = $_SESSION['getWWWResolve'];
    $getIpCanonicalization = $_SESSION['getIpCanonicalization'];
    $hasFavicon = $_SESSION['hasFavicon'];
    $countH1 = $_SESSION['countH1'];
    $checkLang = $_SESSION['checkLang'];
    $checkMetaCharset = $_SESSION['checkMetaCharset'];
    $img = $_SESSION['img'];

    $errorScore = (count($validate['errors'])/15 > 1) ? 100 : count($validate['errors'])/15*100;
    $warnScore = (count($validate['warnings'])/30 > 1) ? 100 : count($validate['warnings'])/30*100;
    $w3CScore = 100 - (0.6*$errorScore + 0.4*$warnScore);
    $arr = explode('/', $countImagesAltTexts);

    if ($arr[1] == 0) {
      $imageAltScore = 100;
    } else {
      $imageAltScore = round($arr[0]/$arr[1]*100);
    }

    $arr = explode('/', $checkCleanUrls);

    if ($arr[1] == 0) {
      $cleanUrlScore = 100;
    } else {
      $cleanUrlScore = round($arr[0]/$arr[1]*100);
    }

    $codeScore = 0.3*$w3CScore + 0.2*$getPagespeedScore + 0.1*$imageAltScore + 0.05*$cleanUrlScore;

    if ($getWWWResolve) {$codeScore = $codeScore + 0.1*100;}
    if ($getIpCanonicalization) {$codeScore = $codeScore + 0.05*100;}
    if ($hasFavicon) {$codeScore = $codeScore + 0.05*100;}
    if ($checkLang != '') {$codeScore = $codeScore + 0.05*100;}
    if ($checkMetaCharset != '') {$codeScore = $codeScore + 0.1*100;}

    $codeScore = round($codeScore);

    $googleIndexScore = log($getSiteindexTotal+1)/10;
    if ($googleIndexScore > 1) {$googleIndexScore = 1;}
    $bingIndexScore = log($getSiteindexTotalBing+1)/10;
    if ($bingIndexScore > 1) {$bingIndexScore = 1;}
    $backLinksScore = log($getGoogleBacklinksTotal+1)/5;
    if ($backLinksScore > 1) {$backLinksScore = 1;}
    $alexaScore = 1000/$getAlexaGlobalRank;
    if ($alexaScore > 1) {$alexaScore = 1;}
    $searchEngineScore = round(0.25*$getGoogleToolbarPageRank*10 + 0.15*$googleIndexScore*100 + 0.15*$bingIndexScore*100 + 0.05*$backLinksScore*100 + 
        0.15*$alexaScore*100 + 0.15*$trustworthiness + 0.1*$childsafety);

    $SEOScore = 0;

    if ($hasRobots == 'true') $SEOScore += 5;
    if ($hasSitemaps != 'false') $SEOScore += 20;
    if (strlen($checkTitle) >= 5) $SEOScore += 20;
    if (strlen($checkMetaDescription) >= 60) $SEOScore += 15;
    if (strlen($checkMetaKeywords) >= 20) $SEOScore += 5;
    if ($countWords >= 50) $SEOScore += 15;
    if($countH1 == 1) $SEOScore += 20;

    $googlePlusScore = log($getGooglePlusOnes+1)/10;

    if ($googlePlusScore > 1) {$googlePlusScore = 1;}
    $facebookScore = log($getFacebookInteractions['total_count']+1)/10;
    if ($facebookScore > 1) {$facebookScore = 1;}
    $twitterScore = log($getTwitterMentions+1)/10;
    if ($twitterScore > 1) {$twitterScore = 1;}
    $socialScore = round(0.3*$googlePlusScore*100 + 0.35*$facebookScore*100 + 0.35*$twitterScore*100);
    $totalScore = round(($codeScore + $searchEngineScore + $SEOScore + $socialScore)/4);

    $userName = $_SESSION["userName"];
    $userEmail = $_SESSION["userEmail"];
    $userPhone = $_SESSION["userPhone"];
    $competitorsType = $_SESSION["competitorsType"];
    $competitor1 = $_SESSION["competitor1"];
    $competitor2 = $_SESSION["competitor2"];
    $competitor3 = $_SESSION["competitor3"];

    $allstat = $_SESSION["allstat"];

    function getScore($urlstmp, $allstat){
        $_validate =  $allstat[$urlstmp]['validate'];
        $_countImagesAltTexts = $allstat[$urlstmp]['countImagesAltTexts'];
        $_checkCleanUrls = $allstat[$urlstmp]['checkCleanUrls'];
        $_getWWWResolve = $allstat[$urlstmp]['getWWWResolve'];
        $_getIpCanonicalization = $allstat[$urlstmp]['getIpCanonicalization'];
        $_hasFavicon = $allstat[$urlstmp]['hasFavicon'];
        $_checkLang = $allstat[$urlstmp]['checkLang'];
        $_checkMetaCharset = $allstat[$urlstmp]['checkMetaCharset'];
        $_getPagespeedScore = $allstat[$urlstmp]['getPagespeedScore'];

        $_errorScore = (count($_validate['errors'])/15 > 1) ? 100 : count($_validate['errors'])/15*100;
        $_warnScore = (count($_validate['warnings'])/30 > 1) ? 100 : count($_validate['warnings'])/30*100;
        $_w3CScore = 100 - (0.6*$_errorScore + 0.4*$_warnScore);
        $_arr = explode('/', $_countImagesAltTexts);
        if ($_arr[1] == 0) {
            $_imageAltScore = 100;
        } else {
        $_imageAltScore = round($_arr[0]/$_arr[1]*100);
        }
        $_arr = explode('/', $_checkCleanUrls);
        if ($_arr[1] == 0) {
          $_cleanUrlScoreScore = 100;
        } else {
          $_cleanUrlScoreScore = round($_arr[0]/$_arr[1]*100);
        }
        $_codeScore = round(0.3*$_w3CScore + 0.2*$_getPagespeedScore + 0.1*$_imageAltScore + 0.05*$_cleanUrlScoreScore);
        if ($_getWWWResolve) {$_codeScore = $_codeScore + 0.1*100;}
        if ($_getIpCanonicalization) {$_codeScore = $_codeScore + 0.05*100;}
        if ($_hasFavicon) {$_codeScore = $_codeScore + 0.05*100;}
        if ($_checkLang != '') {$_codeScore = $_codeScore + 0.05*100;}
        if ($_checkMetaCharset != '') {$_codeScore = $_codeScore + 0.1*100;}
        $_codeScore = round($_codeScore);
        $allstat[$urlstmp]['codeScore'] = $_codeScore;


        $_getGoogleToolbarPageRank = $allstat[$urlstmp]['getGoogleToolbarPageRank'];
        $_getSiteindexTotal = $allstat[$urlstmp]['getSiteindexTotal'];
        $_getSiteindexTotalBing = $allstat[$urlstmp]['getSiteindexTotalBing'];
        $_getGoogleBacklinksTotal = $allstat[$urlstmp]['getGoogleBacklinksTotal'];
        $_getAlexaGlobalRank = $allstat[$urlstmp]['getAlexaGlobalRank'];
        $_getWOT = $allstat[$urlstmp]['getWOT'];
        $_0 = '0';
        $_4 = '4';
        $_trustworthiness = $_getWOT->$_0;
        $_trustworthiness = $_trustworthiness[0];
        $_childsafety = $_getWOT->$_4;
        $_childsafety = $_childsafety[0];

        $_googleIndexScore = log($_getSiteindexTotal+1)/10;
        if ($_googleIndexScore > 1) {$_googleIndexScore = 1;}
        $_bingIndexScore = log($_getSiteindexTotalBing+1)/10;
        if ($_bingIndexScore > 1) {$_bingIndexScore = 1;}
        $_backLinksScore = log($_getGoogleBacklinksTotal+1)/5;
        if ($_backLinksScore > 1) {$_backLinksScore = 1;}
        $_alexaScore = 1000/$_getAlexaGlobalRank;
        if ($_alexaScore > 1) {$_alexaScore = 1;}
        $_searchEngineScore = round(0.25*$_getGoogleToolbarPageRank*10 + 0.15*$_googleIndexScore*100 + 0.15*$_bingIndexScore*100 + 
            0.05*$_backLinksScore*100 + 0.15*$_alexaScore*100 + 0.15*$_trustworthiness + 0.1*$_childsafety);
        $allstat[$urlstmp]['searchEngineScore'] = $_searchEngineScore;


        $_hasRobots = $allstat[$urlstmp]['hasRobots'];
        $_hasSitemaps = $allstat[$urlstmp]['hasSitemaps'];
        $_checkTitle = $allstat[$urlstmp]['checkTitle'];
        $_checkMetaDescription = $allstat[$urlstmp]['checkMetaDescription'];
        $_checkMetaKeywords = $allstat[$urlstmp]['checkMetaKeywords'];
        $_countWords = $allstat[$urlstmp]['countWords'];
        $_countH1 = $allstat[$urlstmp]['countH1'];

        $_SEOScore = 0;
        if ($_hasRobots == 'true') $_SEOScore += 5;
        if ($_hasSitemaps != 'false') $_SEOScore += 20;
        if (strlen($_checkTitle) >= 5) $_SEOScore += 20;
        if (strlen($_checkMetaDescription) >= 60) $_SEOScore += 15;
        if (strlen($_checkMetaKeywords) >= 20) $_SEOScore += 5;
        if ($_countWords >= 50) $_SEOScore += 15;
        if($_countH1 == 1) $_SEOScore += 20;
        $allstat[$urlstmp]['SEOScore'] = $_SEOScore;


        $_getGooglePlusOnes = $allstat[$urlstmp]['getGooglePlusOnes'];
        $_getSiteindexTotal = $allstat[$urlstmp]['getSiteindexTotal'];
        $_getSiteindexTotalBing = $allstat[$urlstmp]['getSiteindexTotalBing'];
        $_getFacebookInteractions = $allstat[$urlstmp]['getFacebookInteractions'];
        $_getTwitterMentions = $allstat[$urlstmp]['getTwitterMentions'];

        $_googlePlusScore = log($_getGooglePlusOnes+1)/10;
        if ($_googlePlusScore > 1) {$_googlePlusScore = 1;}
        $_facebookScore = log($_getFacebookInteractions['total_count']+1)/10;
        if ($_facebookScore > 1) {$_facebookScore = 1;}
        $_twitterScore = log($_getTwitterMentions+1)/10;
        if ($_twitterScore > 1) {$_twitterScore = 1;}
        $_socialScore = round(0.3*$_googlePlusScore*100 + 0.35*$_facebookScore*100 + 0.35*$_twitterScore*100);
        $allstat[$urlstmp]['socialScore'] = $_socialScore;


        $_totalScore = round(($_codeScore + $_searchEngineScore + $_SEOScore + $_socialScore)/4);
        $allstat[$urlstmp]['totalScore'] = $_totalScore;
        return $allstat;
    }

    function getLetterScore($score) {
        if ($score >= 0 && $score <= 20) {
            return 'F';
        } else if ($score >= 21 && $score <= 40) {
            return 'D';
        } else if ($score >= 41 && $score <= 60) {
            return 'C-';
        } else if ($score >= 61 && $score <= 70) {
            return 'C';
        } else if ($score >= 71 && $score <= 80) {
            return 'C+';
        } else if ($score >= 81 && $score <= 90) {
            return 'B-';
        } else if ($score >= 91 && $score <= 99) {
            return 'B+';
        } else if ($score == 100) {
            return 'A';
        }
    }
?>
    	<!-- <div id="mobileClass"></div>
    	<div class="container hidden-pull"></div> -->
        <?php if (!is_null($url)): ?>
            <?php include ('assets/templates/sidebar-sm.php'); ?>
            <?php include ('assets/templates/sidebar-smm.php'); ?>
            <?php include ('assets/templates/sidebar-xs.php'); ?>
        <?php endif; ?>
        <script>
            var url,
                // serviceURL = "http://seotools.dev.local/Services/NATIVERANK/service.php";
                serviceURL = "Services/NATIVERANK/service.php";
            counter_end = 31;
            function ajax_submit(form) {
                counter = 0;
                url = $('#domainInput').val();
                $('.progressbarmaintext').removeClass('hide');
                $('#progressbarmain').removeClass('hide');
                var userName = $('[name=userName]').val();
                var userEmail = $('[name=userEmail]').val();
                var userPhone = $('[name=userPhone]').val();
                competitorsType = false;
                competitor1 = $('[name=competitor1]').val();
                competitor2 = $('[name=competitor2]').val();
                competitor3 = $('[name=competitor3]').val();
                logo = $('[name=logo]:checked').val();
                if (userName == "" || userEmail == "" || userPhone == "") {
                    alert("Please fill all fields!");
                    return;
                }
                $.ajax({
                    type: "POST",
                    url: serviceURL,
                    data: "url="+url+"&service=clean",
                    success: function(msg){
                        $.ajax({
                            type: "POST",
                            url: serviceURL,
                            data: "url="+url+"&service=start&userName="+userName+"&userEmail="+userEmail+"&userPhone="+userPhone+"&logo="+logo+
                                "&competitorsType="+competitorsType+"&competitor1="+competitor1+"&competitor2="+competitor2+"&competitor3="+competitor3,
                            success: function(msg){
                                check();
                            }
                        });
                    }
                });
            }
            function check() {
                var array = new Array(  "validate", "getPagespeedScore", "parser","getDomainAge","getWWWResolve",
                                        "getIpCanonicalization","hasFavicon","hasRobots", "hasSitemaps", 
                                        "getGoogleToolbarPageRank", "getGoogleBacklinksTotal", "getGooglePlusOnes", 
                                        "getSiteindexTotal", "getSiteindexTotalBing", "getFacebookInteractions", 
                                        "getTwitterMentions", "getAlexaGlobalRank","getSEMRushDomainRank",
                                        "getSEMRushOrganicKeywords", "getSEMRushPaidSearch", "getWOT" );
                for(var i = 0; i < array.length; i++){
                // for(var i = 2; i < 3; i++){
                    var serviceNameString = array[i];
                    $.ajax({
                        type: "POST",
                        url: serviceURL,
                        data: "url="+url+"&service="+array[i],
                        success: function(msg) {
                            if (msg == "")
                                console.log("response is empty.");
                            else
                                console.log(msg);
                            var result = $.parseJSON(msg);
                            
                            for(key in result) {
                                counter++;
                                $('#barmain')[0].style.width=counter/counter_end*100+'%';
                                if(counter == counter_end){
                                    $('.progressbarmaintext').addClass('hide');
                                    $('#progressbarmain').addClass('hide');
                                    $('.progressbarcompetitorstext').removeClass('hide');
                                    $('#progressbarcompetitors').removeClass('hide');
                                    if (competitorsType) {
                                        $.ajax({
                                            type: "POST",
                                            url: serviceURL,
                                            data: "url="+url+"&service=competitors",
                                            success: function(msg){
                                                checkCompetitors(msg);
                                            }
                                        });
                                    } else {
                                        result = 0;
                                        competitors = new Array();
                                        if (competitor1 != "") {
                                            competitors[result] = competitor1;
                                            result++;
                                        }
                                        if (competitor2 != "") {
                                            competitors[result] = competitor2;
                                            result++;
                                        }
                                        if (competitor3 != "") {
                                            competitors[result] = competitor3;
                                            result++;
                                        }
                                        urlCompetitor = "url="+url+"&service=competitorsManual&count="+result;
                                        for(var i = 0; i < result; i++){
                                            urlCompetitor = urlCompetitor+"&competitor"+i+"="+competitors[i];
                                        }
                                        $.ajax({
                                            type: "POST",
                                            url: serviceURL,
                                            data: urlCompetitor,
                                            success: function(msg){
                                                checkCompetitorsManual(result);
                                            }
                                        });
                                    }
                                }
                            }
                        }
                    });
                }
            }
            function checkCompetitors(msg) {
                result = parseInt($.parseJSON(msg));
                counter = 0;
                if (result == 0){
                    $.ajax({
                        type: "POST",
                        url: serviceURL,
                        data: "url="+url+"&service=finish",
                        success: function(msg){
                            window.location.href = 'index.php';
                        }
                    });
                    return;
                }

                for(var i = 0; i < result; i++){
                    $.ajax({
                        type: "POST",
                        url: serviceURL,
                        data: "url="+url+"&service=competitor"+i,
                        success: function(msg){
                            counter++;
                            $('#barcompetitors')[0].style.width=counter/result*100+'%';
                            if(counter == result) {
                                $.ajax({
                                    type: "POST",
                                    url: serviceURL,
                                    data: "url="+url+"&service=finish",
                                    success: function(msg){
                                        window.location.href = 'index.php';
                                    }
                                });
                            }
                        }
                    });
                }
            }
            function checkCompetitorsManual(result) {
                counter = 0;
                if (result == 0){
                    $.ajax({
                        type: "POST",
                        url: serviceURL,
                        data: "url="+url+"&service=finish",
                        success: function(msg){
                            window.location.href = 'index.php';
                        }
                    });
                    return;
                }
                for(var i = 0; i < result; i++){
                    $.ajax({
                        type: "POST",
                        url: serviceURL,
                        data: "url="+url+"&service=competitor"+i,
                        success: function(msg){
                            counter++;
                            $('#barcompetitors')[0].style.width=counter/result*100+'%';
                            if(counter == result) {
                                $.ajax({
                                    type: "POST",
                                    url: serviceURL,
                                    data: "url="+url+"&service=finish",
                                    success: function(msg){
                                        window.location.href = 'index.php';
                                    }
                                });
                            }
                        }
                    });
                }
            }
        </script>
        <div class="button-container-wrapper">
        	<div id="main-container" class="container button-container">
        		<div class="row">
        			<div class="col-md-12 col-md-offset-0 col-sm-12 col-sm-offset-0 main-butt">
        				<form name="form" method="post" onsubmit="ajax_submit(this);return false;" class="form-inline form-domain">
                            <div class="input-group userdata-container">
                                <input class="form-control userdata" type="hidden" name="userName" placeholder="Name"
                                    <?php if (isset($userName)) echo ' value="'.$userName.'"' ?>
                                >
                                <input class="form-control userdata" type="hidden" name="userEmail" placeholder="Email"
                                    <?php if (isset($userEmail)) echo ' value="'.$userEmail.'"' ?>
                                >
                                <input class="form-control userdata" type="hidden" name="userPhone" placeholder="Phone"
                                    <?php if (isset($userPhone)) echo ' value="'.$userPhone.'"' ?>
                                >
                            </div>
                            <div class="input-group competitorsdata-container">
                                <span class="input-group-addon competitors-checkbox">
                                    <!-- <input type="checkbox" id="competitors_checkbox" name="competitorsType" 
                                        <?php if (!isset($competitorsType) || $competitorsType == "true") echo ' checked' ?>
                                    > -->
                                    Competitors:
                                </span>
                                <input class="form-control competitorsdata" type="text" name="competitor1" placeholder="Competitor #1 URL"
                                    <?php if (isset($competitor1)) echo ' value="'.$competitor1.'"' ?>
                                >
                                <input class="form-control competitorsdata" type="text" name="competitor2" placeholder="Competitor #2 URL"
                                    <?php if (isset($competitor2)) echo ' value="'.$competitor2.'"' ?>
                                >
                                <input class="form-control competitorsdata" type="text" name="competitor3" placeholder="Competitor #3 URL"
                                    <?php if (isset($competitor3)) echo ' value="'.$competitor3.'"' ?>
                                >
                            </div>
                            <div class="input-group">
                                <input class="form-control" id="domainInput" type="text" name="url" placeholder="domain.com"
                                    <?php if (isset($url)) echo ' value="'.$url.'"' ?>
                                >
                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-primary">Analyze!</button>
                                </div>
                            </div>
        				</form>
        			</div>
        		</div>
                <div class="row">
                    <div class="progressbarmaintext hide">Analyzing your site!</div>
                    <div id="progressbarmain" class="hide">
                        <div class="row" style="width: 0%" id="barmain"></div>
                    </div>
                    <div class="progressbarcompetitorstext hide">Analyzing your competitors!</div>
                    <div id="progressbarcompetitors" class="hide">
                        <div style="width: 0%" id="barcompetitors"></div>
                    </div>
                </div>
        	</div>
        </div>
    	<div id="main-container">
            <?php if (!is_null($url) && !is_null($finish)): ?>
                <div class="col-md-4 visible-desktop">
    			<?php include ('assets/templates/sidebar.php'); ?>
                </div>
                <div class="col-md-8 result-section">
    			<?php include ('assets/templates/content.php'); ?>
                </div>
            <?php endif; ?>
    	</div>
<?php 
    }
    else {
?>
        <div style="text-align:center;font-size:16px;margin-top:50px;">
            Welcome to SEO Tool! Click <a href="login.php">here</a> to use the tool
        </div>
<?php
    }
    include ('assets/templates/footer.php'); 
?>