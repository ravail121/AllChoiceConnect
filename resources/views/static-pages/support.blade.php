@extends('layouts.app')

@section('content')

<div class="wrapper supportWrapper">
    <section class="faqs">
        <nav>
            <ul>
                <li><a href="#" data-category="4" class="active">Pre-sale</a></li>
                <li><a href="#" data-category="7">Features</a></li>
                <li><a href="#" data-category="5">Porting</a></li>
                <li><a href="#" data-category="3">Troubleshooting</a></li>
                <li><a href="#" data-category="1">Roaming</a></li>
                <li><a href="#" data-category="2">Data</a></li>
                <li><a href="#" data-category="6">My Account</a></li>
            </ul>
        </nav>

        <ul class="questions">

            <li data-category="2" style="display: none;">
                <h2>I have cellular connection, but my internet isn't working<i>.</i></h2>
                <div class="answer">
                    <p>Ensure that your APN settings are correct by matching the information below:<br>
                        <br> Name: T-MOBILE<br> APN: fast.tmobile.com but if it’s not an LTE Device, use: epc.tmobile.com instead<br> Proxy:
                        <leave in="" blank=""><br> Port:
                            <leave in="" blank=""><br> Username:
                                <leave in="" blank=""><br> Password:
                                    <leave in="" blank=""><br> Server:
                                        <leave in="" blank=""><br> MMSC: http://mms.msg.eng.t-mobile.com/mms/wapenc<br> MMS proxy:
                                            <leave in="" blank=""><br> MMS port:
                                                <leave in="" blank=""><br> MCC: 310<br> MNC: 260<br> Authentication type:
                                                    <leave in="" blank=""><br> APN type: default,supl,mms<br> APN Protocol: Leave it to the Default one<br>
                                                        <br> If this did not resolve the issue, please get in touch with us and we will send out a network update for your line.</leave>
                                                </leave>
                                            </leave>
                                        </leave>
                                    </leave>
                                </leave>
                            </leave>
                        </leave>
                    </p>
                </div>
            </li>
            <li data-category="2" style="display: none;">
                <h2>All I need to know about International Roaming<i>.</i></h2>
                <div class="answer">
                    <p>International Roaming is disabled on all voice lines, and is available upon request. Data-only lines are enabled by default. <br>
                        <br> In order to enable International Roaming please send us a request to support@teltik.com and we will respond shortly after with the International Roaming Terms. Once you respond with your consent, we will enable International
                        Roaming on your line.<br>
                        <br> International Roaming cannot be enabled within the first 30 days of service.<br>
                        <br> Please note that data and text is free in the included countries (see list of countries below). In addition, calls made through WiFi Calling back to the US only, are free as well.<br>
                        <br> However, calls made over CELLULAR connection while roaming outside the US or Canada, including incoming and outgoing calls, as well as voicemail retrieval, are not free and will be charged $0.35 per minute.<br>
                        <br> International Roaming will be enabled for a period of 30 days. If you plan to make frequent trips abroad and would like it enabled for a longer period of time, please let us know.<br>
                        <br> For support while roaming, call T-Mobile's International Support desk. Dial +1-505-998-3793 (this is a FREE call from your T-Mobile phone) or 001-505-998-3793 (from a land-line).<br>
                        <br> Please note: International Roaming includes voice, text and data. However, even when this feature is enabled, it will only work in certain countries and certain parts of the world. There are places throughout the world that
                        International Roaming will work, but at an additional charge. So before enabling this feature, be sure to check the coverage at your destination by clicking <a href="https://www.t-mobile.com/coverage/roaming">HERE</a>. Coverage
                        on a cruise or ferry are not included either, and exact rates can be found using the same link.<br>
                        <br> ---
                        <br>
                        <br> Automatic coverage in over 210 countries and destinations.<br>
                        <br> Unlimited international data coverage and texting are included with all plans at no additional charge. It's just 35 cents per minute for calls to mobile devices and landlines, as well as voicemail retrieval.<br>
                        <br> Afghanistan
                        <br> Aland Islands<br> Albania
                        <br> Alderney
                        <br> Algeria
                        <br> Andorra
                        <br> Angola
                        <br> Anguilla
                        <br> Antigua and Barbuda<br> Argentina
                        <br> Armenia
                        <br> Aruba
                        <br> Australia
                        <br> Austria
                        <br> Azerbaijan
                        <br> Azores
                        <br> Bahamas
                        <br> Bahrain
                        <br> Bangladesh
                        <br> Barbados
                        <br> Belarus
                        <br> Belgium
                        <br> Belize
                        <br> Benin
                        <br> Bermuda
                        <br> Bolivia
                        <br> Bonaire
                        <br> Bosnia and Herzegovina<br> Brazil
                        <br> British Virgin Islands<br> Brunei Darussalam<br> Bulgaria
                        <br> Burkina Faso<br> Burundi
                        <br> Cambodia
                        <br> Cameroon
                        <br> Canada
                        <br> Canary Islands<br> Cape Verde<br> Cayman Islands<br> Chad
                        <br> Chile
                        <br> China
                        <br> Christmas Island<br> Colombia
                        <br> Congo
                        <br> Congo, Democratic Republic<br> Costa Rica<br> Cote d'Ivoire<br> Croatia
                        <br> Curacao
                        <br> Cyprus
                        <br> Czech Republic<br> Denmark
                        <br> Dominica
                        <br> Dominican Republic<br> Easter Island<br> Ecuador
                        <br> Egypt
                        <br> El Salvador<br> Estonia
                        <br> Faroe Islands<br> Fiji
                        <br> Finland
                        <br> France
                        <br> French Guiana<br> French Polynesia<br> Gabon
                        <br> Gambia
                        <br> Georgia
                        <br> Germany
                        <br> Ghana
                        <br> Gibraltar
                        <br> Greece
                        <br> Greenland
                        <br> Grenada
                        <br> Guadeloupe
                        <br> Guam
                        <br> Guatemala
                        <br> Guernsey
                        <br> Guinea
                        <br> Guinea-Bissau
                        <br> Guyana
                        <br> Haiti
                        <br> Herm
                        <br> Honduras
                        <br> Hong Kong<br> Hungary
                        <br> Iceland
                        <br> India
                        <br> Indonesia
                        <br> Iraq
                        <br> Ireland
                        <br> Isle of Man<br> Israel
                        <br> Italy
                        <br> Jamaica
                        <br> Japan
                        <br> Jersey
                        <br> Jordan
                        <br> Kazakhstan
                        <br> Kenya
                        <br> Kosovo
                        <br> Kuwait
                        <br> Kyrgyzstan
                        <br> Laos
                        <br> Latvia
                        <br> Liberia
                        <br> Lichtenstein
                        <br> Lithuania
                        <br> Luxembourg
                        <br> Macau
                        <br> Macedonia
                        <br> Madagascar
                        <br> Madeira
                        <br> Malawi
                        <br> Malaysia
                        <br> Maldives
                        <br> Mali
                        <br> Malta
                        <br> Marie Galante<br> Martinique
                        <br> Mauritania
                        <br> Mauritius
                        <br> Mayotte
                        <br> Mexico
                        <br> Moldova
                        <br> Monaco
                        <br> Mongolia
                        <br> Montenegro
                        <br> Montserrat
                        <br> Morocco
                        <br> Mozambique
                        <br> Myanmar
                        <br> Nauru
                        <br> Netherlands
                        <br> Netherlands Antilles<br> New Zealand<br> Nicaragua
                        <br> Niger
                        <br> Nigeria
                        <br> Northern Ireland<br> Northern Mariana Islands (Saipan)<br> Norway
                        <br> Oman
                        <br> Pakistan
                        <br> Palestinian Territories<br> Panama
                        <br> Papua New Guinea<br> Paraguay
                        <br> Peru
                        <br> Philippines
                        <br> Poland
                        <br> Portugal
                        <br> Qatar
                        <br> Reunion
                        <br> Romania
                        <br> Russia
                        <br> Rwanda
                        <br> Saint Barthelemy<br> Saint Eustatius<br> Saint Kitts and Nevis<br> Saint Lucia<br> Saint Martin<br> Saint Saba<br> Saint Vincent and the Grenadines<br> Samoa
                        <br> San Marino<br> Sark Island<br> Saudi Arabia<br> Scotland
                        <br> Senegal
                        <br> Serbia
                        <br> Seychelles
                        <br> Sierra Leone<br> Singapore
                        <br> Sint Maarten<br> Slovakia
                        <br> Slovenia
                        <br> South Africa<br> South Korea<br> Spain
                        <br> Sri Lanka<br> Suriname
                        <br> Svalbard
                        <br> Sweden
                        <br> Switzerland
                        <br> Taiwan
                        <br> Tajikistan
                        <br> Tanzania
                        <br> Thailand
                        <br> Togo
                        <br> Tonga
                        <br> Trinidad and Tobago<br> Tunisia
                        <br> Turkey
                        <br> Turkmenistan
                        <br> Turks and Caicos Islands<br> Uganda
                        <br> Ukraine
                        <br> United Arab Emirates<br> United Kingdom<br> Uruguay
                        <br> Uzbekistan
                        <br> Vatican City<br> Venezuela
                        <br> Vietnam
                        <br> Wales
                        <br> Western Sahara<br> Zambia
                        <br> Zimbabwe
                        <br>
                        <br>
                        <br> Additional charges apply in excluded destinations; included destinations subject to change. Taxes additional; usage taxed in some countries. Voice and text features for direct communications between 2 people. Communications
                        with premium-rate (e.g., 900, entertainment, high-rate helpline) numbers not included and may incur additional charges. Calls over cellular while roaming outside of the USA will be charged at $0.35 per minute (no charge for Wi-Fi
                        calls to U.S.) Coverage not available in some areas; we are not responsible for the performance of roaming partners' networks. Standard speeds approx. 128 Kbps. No tethering.</p>
                </div>
            </li>
            <li data-category="2" style="display: none;">
                <h2>Wi-Fi Calling<i>.</i></h2>
                <div class="answer">
                    <p>More access in more places. <br>
                        <br> Wi-Fi Calling to the US is included. Even if you are overseas, all calls back to the US are free when made through Wi-Fi Calling.<br>
                        <br> Wi-Fi Calling allows you to make and receive calls over a wireless internet connection. To use Wi-Fi Calling simply connect to an available Wi-Fi network of your choice, confirm Wi-Fi Calling is enabled on your phone, and
                        continue to use all of your favorite device features!<br>
                        <br>
                    </p>
                </div>
            </li>
            <li data-category="2" style="display: none;">
                <h2>How do I upgrade or downgrade my plan?<i>.</i></h2>
                <div class="answer">
                    <p>Upgrading and downgrading plans as well as adding or removing features is really simple.<br>
                        <br> 1. Click sign in<br> 2. Log in with your credentials<br> 3. Under Monthly Billing, locate the phone number that you would like to change the plan for.<br> 4. Click the drop down on the right hand side of that number<br> 5.
                        Select the 'Change my plan' option<br> 6. Continue through the steps as prompted <br>
                        <br> If upgrading, the new plan will be applied to that line. The change will take effect within several hours. In addition, your card on file will get charged the price difference for the upgrade added. For example, if you are
                        on the $25 plan, your billing cycle is on the 1st of the month, and on the 15th you upgrade to the $30 plan, the difference is $5. You will be charged the entire difference, which will cover you until the end of the month. Upon
                        the next billing cycle, you will get charged the new rate.<br>
                        <br> If downgrading, the effect will only take place at the beginning of the next upcoming billing cycle, at which point you will be charged the new rate.</p>
                </div>
            </li>
            <li data-category="2" style="display: none;">
                <h2>Is the T-Mobile unlimited video streaming included?<i>.</i></h2>
                <div class="answer">
                    <p>Yes!<br>
                        <br> All qualifying plans - with 3GB or more - can also take advantage of the unlimited video streaming and it won’t count towards your 4G LTE data. Data charges do not apply! Please note however, that access to the actual video
                        streaming services are NOT included, rather just that the data which they use will not count towards your high speed data allotment of your plan. <br>
                        <br> Click <a href="https://www.t-mobile.com/offer/binge-on-streaming-video.html">HERE</a> to review the list of approved streaming services.<br>
                        <br> Ensure your BingeOn is enabled by checking the status, dial #BNG# (#264#) from your phone. To turn on dial #BON# (#266#), and to turn off dial #BOF# (#263#)</p>
                </div>
            </li>
            <li data-category="2" style="display: none;">
                <h2>Is the T-Mobile unlimited music streaming included?<i>.</i></h2>
                <div class="answer">
                    <p>Yes! <br>
                        <br> You will have access to T-Mobile's Music Freedom feature. Stream as much music as you want on your smartphone from top streaming services, and it won’t count towards your 4G LTE data plan. Data charges do not apply! Please
                        note however, that access to the actual music streaming services are NOT included, rather just that the data which they use will not count towards your high speed data allotment of your plan. <br>
                        <br> Click <a href="https://www.t-mobile.com/offer/free-music-streaming.html">HERE</a> to review the list of approved streaming services.</p>
                </div>
            </li>
            <li data-category="2" style="display: none;">
                <h2>What if I need more High-Speed data?<i>.</i></h2>
                <div class="answer">
                    <p>You can easily upgrade your plan in your account portal. Your upgraded data should apply within 12 hours. <br>
                        <br> See 'How do I upgrade or downgrade my plan?' for details on how to get this done.</p>
                </div>
            </li>
            <li data-category="2" style="display: none;">
                <h2>How can I see how much data I have used this month?<i>.</i></h2>
                <div class="answer">
                    <p>Simply dial code #932# and your phone will show you how much data you have used. Please remember that music streaming from included platforms DO NOT count against your data usage and are therefore not included in this tally.</p>
                </div>
            </li>
            <li data-category="2" style="display: none;">
                <h2>Is my data really always unlimited?<i>.</i></h2>
                <div class="answer">
                    <p>Yes. Your data will never be cut off. <br>
                        <br> All our plans include UNLIMITED talk, text, and data. However, amount of 4G LTE - High-speed data is subject to the package you choose. After you run out of your allotted amount, you will be throttled to slower speeds but
                        still be connected.<br>
                        <br> For the Unlimited LTE plans, you get unlimited 4G LTE - High-speed data. However, during times of congestion, it is subject to network deprioritization (currently estimated at approximately 50GB). <br>
                        <br> To explain, if you use more than 50GB of data in one cycle, your data usage will be prioritized below others for the remainder of that data cycle. The only time that you’re likely to see the effects of that, though, is when
                        you’re at a location on the network that is congested, during which time you may see slower speeds. Once you move to a different location or the congestion goes down, your speeds will likely go back up. And once the new data cycle
                        rolls around, your usage will be reset.</p>
                </div>
            </li>
            <li data-category="2" style="display: none;">
                <h2>How to enable HD video?<i>.</i></h2>
                <div class="answer">
                    <p>The following plans allow HD video streaming: TeltikOne Plus ($50), TeltikOne Plus International ($65), TabletOne Plus ($40), and the TabletOne Plus International ($55). However, they need to be enabled on your end. Here is the lowdown
                        on how to do it:<br>
                        <br> 1. Open the T-Mobile app.<br> 2. Select Profile Settings in the top-right corner.<br> 3. Select Media Settings.<br> 4. To the right of HD Video Resolution, slide the toggle to turn it ON.</p>
                </div>
            </li>
            <li data-category="2" style="display: none;">
                <h2>When does my data reset?<i>.</i></h2>
                <div class="answer">
                    <p>Great question! Your billing cycle date and data reset date are not necessarily the same day. Your billing cycle date - the day your bill is due every month, will always be the day of the month on which you placed your first order.
                        Your data reset date, however, is on the 11th of every month. </p>
                </div>
            </li>
            <li data-category="7" style="display: none;">
                <h2>Wi-Fi Calling<i>.</i></h2>
                <div class="answer">
                    <p>More access in more places. <br>
                        <br> Wi-Fi Calling to the US is included. Even if you are overseas, all calls back to the US are free when made through Wi-Fi Calling.<br>
                        <br> Wi-Fi Calling allows you to make and receive calls over a wireless internet connection. To use Wi-Fi Calling simply connect to an available Wi-Fi network of your choice, confirm Wi-Fi Calling is enabled on your phone, and
                        continue to use all of your favorite device features!<br>
                        <br>
                    </p>
                </div>
            </li>
            <li data-category="7" style="display: none;">
                <h2>Will I have service in Canada?<i>.</i></h2>
                <div class="answer">
                    <p>Yes! All our plans include service in Canada. You can also use your phone to call numbers in Canada from US, at no extra cost!<br>
                        <br> Service in Canada will work as it does in the US with unlimited talk, text and data. High-speed data in Canada will be capped at 5GB. After 5GB of high-speed data is used (or your high-speed data allotment is reached, whichever
                        comes first), you will stay connected with unlimited data at up to 128kbps (or 256kbps with TeltikOne Plus). <br>
                        <br> The OnePlus International plans, on voice lines and tablets, will have unlimited 4G LTE with no cap.</p>
                </div>
            </li>
            <li data-category="7" style="display: none;">
                <h2>Call Forwarding<i>.</i></h2>
                <div class="answer">
                    <p>To turn on Call Forwarding:<br> Dial **21* + the phone number including area code, followed by #.<br> Example: **21*123-456-7890#<br> Press the call button.<br> A confirmation message is displayed on your device letting you know that
                        Call Forwarding has been turned on.<br>
                        <br> To turn off all Call Forwarding:<br> Dial ##21#<br> Press the call button.<br> A confirmation message is displayed on your device letting you know that Call Forwarding has been turned off.</p>
                </div>
            </li>
            <li data-category="7" style="display: none;">
                <h2>How to enable International Roaming?<i>.</i></h2>
                <div class="answer">
                    <p>International Roaming is disabled on all voice lines, but enabled on all data-only lines. <br>
                        <br> In order to enable International Roaming on your voice line, please send us an email to support@teltik.com with your phone number and request. We will respond shortly after with the International Roaming Terms. Once you respond
                        with your consent, we will enable International Roaming on your line.<br>
                        <br> International Roaming cannot be enabled within the first 30 days of service.<br>
                        <br> For more details about this feature, please see FAQ titled "All I need to know about international roaming."</p>
                </div>
            </li>
            <li data-category="7" style="display: none;">
                <h2>Stateside International Calling<i>.</i></h2>
                <div class="answer">
                    <p>By adding the Stateside International Calling feature to your plan, you will get:<br> - Unlimited mobile-to-landline calling to 70+ countries<br> - Unlimited mobile-to-mobile calling to 30+ countries<br> - Calls to other countries
                        at a reduced rate<br>
                        <br> See a complete list of included countries, click <a href="https://www.t-mobile.com/optional-services/international-calling-mobile-countries.html">HERE</a>. (The top list includes all countries that allow calls to landline
                        AND mobile numbers, the bottom list includes countries that allow ONLY calls to landlines.) To search for specific countries not included in that list, click <a href="https://www.t-mobile.com/optional-services/international-calling.html#check-rates">HERE</a>.
                        <br>
                        <br> PLEASE NOTE: Some countries include an additional rate-per-minute, on top of the $15 monthly fee. Enter the desired country, and click Check Rates. In the chart that will appear below, look through the row that reads “Stateside
                        International Talk $15/mo per line,” in both the Mobile-to-Landline and Mobile-to-Mobile columns.<br>
                        <br> IMPORTANT: This feature does not stand in effect while roaming internationally - traveling abroad - including while in Canada or Mexico. The regular Pay-Per-Use rate, as well as the International Roaming Terms will apply.
                        <br>
                        <br> By enabling this feature, your line may become more susceptible to additional charges. Therefore, any and all charges that are associated with your line as a result are solely your responsibility. Your card on file will automatically
                        be charged on a monthly basis for any additional usage charges during the previous billing cycle. The charge will be the rate-per-minute, plus 5% covering taxes and fees.</p>
                </div>
            </li>
            <li data-category="7" style="display: none;">
                <h2>Enhanced Voice Services<i>.</i></h2>
                <div class="answer">
                    <p>Enhanced Voice Service (EVS) offers more reliability, with less dropped calls on LTE, and higher quality. EVS works on WiFi and will work even if the person you called doesn't have it.</p>
                </div>
            </li>
            <li data-category="7" style="display: none;">
                <h2>Short codes, what are my options? <i>.</i></h2>
                <div class="answer">
                    <p>Third party billing is blocked as much as possible to protect your account. Many clients have successfully been using Google Voice to receive short code messages and this has been working well for them. Should you accrue any third
                        party charges, they will be added to your account + 5% covering taxes and fees, and automatically charged on your next invoice.</p>
                </div>
            </li>
            <li data-category="7" style="display: none;">
                <h2>How to enable HD video?<i>.</i></h2>
                <div class="answer">
                    <p>The following plans allow HD video streaming: TeltikOne Plus ($50), TeltikOne Plus International ($65), TabletOne Plus ($40), and the TabletOne Plus International ($55). However, they need to be enabled on your end. Here is the lowdown
                        on how to do it:<br>
                        <br> 1. Open the T-Mobile app.<br> 2. Select Profile Settings in the top-right corner.<br> 3. Select Media Settings.<br> 4. To the right of HD Video Resolution, slide the toggle to turn it ON.</p>
                </div>
            </li>
            <li data-category="7" style="display: none;">
                <h2>Is the T-Mobile unlimited music streaming included?<i>.</i></h2>
                <div class="answer">
                    <p>Yes! <br>
                        <br> You will have access to T-Mobile's Music Freedom feature. Stream as much music as you want on your smartphone from top streaming services, and it won’t count towards your 4G LTE data plan. Data charges do not apply! Please
                        note however, that access to the actual music streaming services are NOT included, rather just that the data which they use will not count towards your high speed data allotment of your plan. <br>
                        <br> Click <a href="https://www.t-mobile.com/offer/free-music-streaming.html">HERE</a> to review the list of approved streaming services.</p>
                </div>
            </li>
            <li data-category="7" style="display: none;">
                <h2>What is the business Cloud-Phone?<i>.</i></h2>
                <div class="answer">
                    <p>With your Teltik business package, you get an iPlum account free of charge! Your iPlum account will allow you to enhance your image with a dedicated business number that works across multiple devices, anywhere in the world. <br>
                        <br> The system we offer is cloud based, which means it's hosted and stored on the internet.<br>
                        <br> You will get 10 iPlum Credits a month for free. Credits are used by making and taking calls, as well as sending and receiving messages. Calls are one Credit per minute, and text message are one Credit per message. Additional
                        Credits are available for purchase from iPlum directly. </p>
                </div>
            </li>
            <li data-category="7" style="display: none;">
                <h2>Is the T-Mobile unlimited video streaming included?<i>.</i></h2>
                <div class="answer">
                    <p>Yes!<br>
                        <br> All qualifying plans - with 3GB or more - can also take advantage of the unlimited video streaming and it won’t count towards your 4G LTE data. Data charges do not apply! Please note however, that access to the actual video
                        streaming services are NOT included, rather just that the data which they use will not count towards your high speed data allotment of your plan. <br>
                        <br> Click <a href="https://www.t-mobile.com/offer/binge-on-streaming-video.html">HERE</a> to review the list of approved streaming services.<br>
                        <br> Ensure your BingeOn is enabled by checking the status, dial #BNG# (#264#) from your phone. To turn on dial #BON# (#266#), and to turn off dial #BOF# (#263#)</p>
                </div>
            </li>
            <li data-category="7" style="display: none;">
                <h2>What does my plan include? ($20 - 2GB plan)<i>.</i></h2>
                <div class="answer">
                    <p>The $20 2GB plan runs on the T-Mobile network, and includes: <br>
                        <br> - Unlimited talk, text, and data<br> - First 2GB at high-speed 4G LTE data<br> - Unlimited music streaming (from included services)<br> - Unlimited domestic roaming <br> - Calls to and within Canada<br> - Mobile Hotspot (counts
                        against LTE data allotment) <br> - WiFi Calling<br>
                        <br> With Teltik, you can enjoy dedicated and reliable 24 hour customer care, and get service with no annual fee, no rate increase, no activation fee, no contracts, and no overage charges. All our plans include a powerful business
                        Cloud-phone system, with a dedicated business line, seamless call forwarding, business hours, and more.</p>
                </div>
            </li>
            <li data-category="7" style="display: none;">
                <h2>What does my plan include? ($30 - 6GB plan)<i>.</i></h2>
                <div class="answer">
                    <p>The $30 6GB plan runs on the T-Mobile network, and includes: <br>
                        <br> - Unlimited talk, text, and data<br> - First 6GB at high-speed 4G LTE data<br> - Unlimited music streaming (from included services)<br> - Unlimited video streaming (at 480p using BingeOn - from included services)<br> - Rollover
                        data (up to 20GB for 12 months)<br> - Unlimited domestic roaming <br> - Calls to and within Canada (LTE data up to 5GB)<br> - Mobile Hotspot (counts against LTE data allotment) <br> - WiFi Calling<br>
                        <br> With Teltik, you can enjoy dedicated and reliable 24 hour customer care, and get service with no annual fee, no rate increase, no activation fee, no contracts, and no overage charges. All our plans include a powerful business
                        Cloud-phone system, with a dedicated business line, seamless call forwarding, business hours, and more.<br>
                    </p>
                </div>
            </li>
            <li data-category="7" style="display: none;">
                <h2>What does my plan include? ($40 - TeltikOne)<i>.</i></h2>
                <div class="answer">
                    <p>The $40 TeltikOne Unlimited plan runs on the T-Mobile network, and includes: <br>
                        <br> - Unlimited talk, text<br> - Unlimited high-speed 4G LTE data<br> - Unlimited video streaming (DVD quality - 480p)<br> - Unlimited Mobile Hotspot (at 3G speeds - 512kbps)<br> - Unlimited domestic roaming <br> - Calls to and
                        within Canada (LTE data up to 5GB)<br> - WiFi Calling<br>
                        <br> With Teltik, you can enjoy dedicated and reliable 24 hour customer care, and get service with no annual fee, no rate increase, no activation fee, no contracts, and no overage charges. All our plans include a powerful business
                        Cloud-phone system, with a dedicated business line, seamless call forwarding, business hours, and more.</p>
                </div>
            </li>
            <li data-category="7" style="display: none;">
                <h2>What does my plan include? ($50 - Unlimited - 14GB Mobile Hotspot)<i>.</i></h2>
                <div class="answer">
                    <p>The $50 Unlimited - 14GB Mobile Hotspot plan runs on the T-Mobile network, and includes: <br>
                        <br> - Unlimited talk, text<br> - Unlimited high-speed 4G LTE data<br> - HD video streaming (enabled by default)<br> - Mobile Hotspot (14GB at 4G LTE speeds)<br> - Unlimited domestic roaming <br> - Calls to and within Canada (LTE
                        data up to 5GB)<br> - WiFi Calling<br>
                        <br> With Teltik, you can enjoy dedicated and reliable 24 hour customer care, and get service with no annual fee, no rate increase, no activation fee, no contracts, and no overage charges. All our plans include a powerful business
                        Cloud-phone system, with a dedicated business line, seamless call forwarding, business hours, and more.</p>
                </div>
            </li>
            <li data-category="7" style="display: none;">
                <h2>What does my plan include? ($55 - TeltikOne Plus)<i>.</i></h2>
                <div class="answer">
                    <p>The $55 TeltikOne Plus plan runs on the T-Mobile network, and includes: <br>
                        <br> - Unlimited talk, text<br> - Unlimited high-speed 4G LTE data<br> - HD video streaming (when enabled in MyT-Mobile app)<br> - Unlimited Mobile Hotspot (first 20GB at 4G LTE speeds, then 3G speeds)<br> - International Roaming
                        data at 256kbps (when enabled)<br> - Unlimited domestic roaming <br> - Calls to and within Canada (LTE data up to 5GB)<br> - WiFi Calling<br> - Unlimited domestic Gogo all-flight service<br> - Voicemail to text - Read voicemails
                        on the go<br> - Name ID - Identify calls from unknown numbers<br>
                        <br> With Teltik, you can enjoy dedicated and reliable 24 hour customer care, and get service with no annual fee, no rate increase, no activation fee, no contracts, and no overage charges. All our plans include a powerful business
                        Cloud-phone system, with a dedicated business line, seamless call forwarding, business hours, and more.</p>
                </div>
            </li>
            <li data-category="7" style="display: none;">
                <h2>What does my plan include? ($65 - TeltikOne Plus International)<i>.</i></h2>
                <div class="answer">
                    <p>(PLEASE NOTE: This plan is no longer available for new lines.)<br>
                        <br> The $65 TeltikOne Plus International plan runs on the T-Mobile network, and includes: <br>
                        <br> - Unlimited talk, text<br> - Unlimited high-speed 4G LTE data<br> - HD video streaming (when enabled in MyT-Mobile app)<br> - Unlimited 4G LTE Mobile Hotspot <br> - Unlimited Stateside International calling (to landlines in
                        70+ countries and mobile numbers in 30+ countries)<br> - International Roaming data at 256kbps (when enabled)<br> - Unlimited domestic roaming <br> - Calls to and within Canada (Unlimited 4G LTE data)<br> - WiFi Calling<br> - Unlimited
                        domestic Gogo all-flight service<br> - Voicemail to text - Read voicemails on the go<br> - Name ID - Identify calls from unknown numbers<br>
                        <br> With Teltik, you can enjoy dedicated and reliable 24 hour customer care, and get service with no annual fee, no rate increase, no activation fee, no contracts, and no overage charges. All our plans include a powerful business
                        Cloud-phone system, with a dedicated business line, seamless call forwarding, business hours, and more.</p>
                </div>
            </li>
            <li data-category="7" style="display: none;">
                <h2>What does my plan include? ($20 - 5GB Hotspot)<i>.</i></h2>
                <div class="answer">
                    <p>The $20 5GB Tablet plan runs on the T-Mobile network, and includes: <br>
                        <br> - 5GB high-speed 4G LTE data<br> - Works in Hotspot devices<br> - Mobile Hotspot (counts against LTE data allotment) <br> - Unlimited music streaming (from included services)<br> - Unlimited video streaming (at 480p using
                        BingeOn - from included services)<br>
                        <br> With Teltik, you can enjoy dedicated and reliable 24 hour customer care, and get service with no annual fee, no rate increase, no activation fee, no contracts, and no overage charges. All our plans include a powerful business
                        Cloud-phone system, with a dedicated business line, seamless call forwarding, business hours, and more.</p>
                </div>
            </li>
            <li data-category="7" style="display: none;">
                <h2>What does my plan include? ($30 - TabletOne)<i>.</i></h2>
                <div class="answer">
                    <p>The $30 TabletOne Unlimited plan runs on the T-Mobile network, and includes: <br>
                        <br> - Unlimited high-speed 4G LTE data<br> - Unlimited Mobile Hotspot (at 3G speeds - 512kbps)<br> - Unlimited video streaming (DVD quality - 480p)<br> - LTE data in Canada (up to 5GB)<br>
                        <br> With Teltik, you can enjoy dedicated and reliable 24 hour customer care, and get service with no annual fee, no rate increase, no activation fee, no contracts, and no overage charges. All our plans include a powerful business
                        Cloud-phone system, with a dedicated business line, seamless call forwarding, business hours, and more.</p>
                </div>
            </li>
            <li data-category="7" style="display: none;">
                <h2>What does my plan include? ($45 - TabletOne Plus)<i>.</i></h2>
                <div class="answer">
                    <p>The $45 TabletOne Plus plan runs on the T-Mobile network, and includes: <br>
                        <br> - Unlimited high-speed 4G LTE data<br> - Unlimited Mobile Hotspot (20GB at 4G LTE speeds, then 3G speeds)<br> - HD video streaming (when enabled in MyT-Mobile app)<br> - LTE data in Canada (up to 5GB)<br> - International Roaming
                        data at 256kbps (when enabled)<br> - Unlimited domestic Gogo all-flight service<br>
                        <br> With Teltik, you can enjoy dedicated and reliable 24 hour customer care, and get service with no annual fee, no rate increase, no activation fee, no contracts, and no overage charges. All our plans include a powerful business
                        Cloud-phone system, with a dedicated business line, seamless call forwarding, business hours, and more.</p>
                </div>
            </li>
            <li data-category="7" style="display: none;">
                <h2>What does my plan include? ($55 - TabletOne Plus International)<i>.</i></h2>
                <div class="answer">
                    <p>(PLEASE NOTE: This plan is no longer available for new lines.)<br>
                        <br> The $55 TabletOne Plus International plan runs on the T-Mobile network, and includes: <br>
                        <br> - Unlimited high-speed 4G LTE data<br> - Unlimited 4G LTE Mobile Hotspot<br> - HD video streaming (when enabled in MyT-Mobile app)<br> - Unlimited LTE data in Canada<br> - International Roaming data at 256kbps (when enabled)<br>                        - Unlimited domestic Gogo all-flight service<br>
                        <br> With Teltik, you can enjoy dedicated and reliable 24 hour customer care, and get service with no annual fee, no rate increase, no activation fee, no contracts, and no overage charges. All our plans include a powerful business
                        Cloud-phone system, with a dedicated business line, seamless call forwarding, business hours, and more.</p>
                </div>
            </li>
            <li data-category="7" style="display: none;">
                <h2>What does my plan include? (Teltik Cloud-phone)<i>.</i></h2>
                <div class="answer">
                    <p>The Teltik Cloud-phone plan works as a VoIP line, with our sister company iPlum, and includes: <br>
                        <br> - Dedicated business line with new phone number<br> - Outbound and inbound U.S. calls and text messages<br> - Separate caller-ID, call logs, and voicemail with email alert<br> - Works anywhere in the world<br> - 10 iPlum Credits
                        a month, to use at your discretion<br> - Free, unlimited iPlum to iPlum calling &amp; multimedia texting<br> - Usable as a second line on your mobile phone or tablet with iPlum app<br> - Set call-forwarding to an external mobile,
                        landline number or a phone system, up to three lines as once!<br> - And much more...<br>
                        <br> With Teltik, you can enjoy dedicated and reliable 24 hour customer care, and get service with no annual fee, no rate increase, no activation fee, no contracts, and no overage charges. All our plans include a powerful business
                        Cloud-phone system, with a dedicated business line, seamless call forwarding, business hours, and more.<br>
                    </p>
                </div>
            </li>
            <li data-category="6" style="display: none;">
                <h2>What if I need more High-Speed data?<i>.</i></h2>
                <div class="answer">
                    <p>You can easily upgrade your plan in your account portal. Your upgraded data should apply within 12 hours. <br>
                        <br> See 'How do I upgrade or downgrade my plan?' for details on how to get this done.</p>
                </div>
            </li>
            <li data-category="6" style="display: none;">
                <h2>What is my Visual Voicemail default password?<i>.</i></h2>
                <div class="answer">
                    <p>Your default password is usually the last four digits of your phone number.</p>
                </div>
            </li>
            <li data-category="6" style="display: none;">
                <h2>Can I activate my own T-Mobile SIM card with your service?<i>.</i></h2>
                <div class="answer">
                    <p>Great question! The choice is yours. You may either purchase a SIM card though Teltik, or you may bring your own SIM.<br>
                        <br> Please note: Should you choose to bring your own SIM, it MUST meet the following two criteria:<br>
                        <br> 1. It MUST be T-Mobile branded (not co-branded/MVNO)<br> 2. It MUST be new and unused. <br>
                        <br> The SIM card will not work if these conditions are not met.<br>
                        <br> The option to choose whether to use your own SIM or purchase one through Teltik is asked during signup.</p>
                </div>
            </li>
            <li data-category="6" style="display: none;">
                <h2>When will my SIM card get shipped?<i>.</i></h2>
                <div class="answer">
                    <p>SIM cards are shipped out the same business day, providing the order is placed before 1:30PM. During holidays and weekends, shipments will be sent out within 48 hours. <br>
                        <br> SIM cards are shipped via USPS. However, if you are trying to "time" your order to coincide with the end of a billing cycle, give yourself a little leeway so that there is no lapse in service. If porting, ensure that you have
                        enough time to receive your SIM and port your number over before your current carriers billing cycle is up. Porting out of a inactive account is blocked by many carriers. <br>
                        <br> Once shipped, you will receive a tracking number via email.<br>
                    </p>
                </div>
            </li>
            <li data-category="6" style="display: none;">
                <h2>Short codes, what are my options? <i>.</i></h2>
                <div class="answer">
                    <p>Third party billing is blocked as much as possible to protect your account. Many clients have successfully been using Google Voice to receive short code messages and this has been working well for them. Should you accrue any third
                        party charges, they will be added to your account + 5% covering taxes and fees, and automatically charged on your next invoice.</p>
                </div>
            </li>
            <li data-category="6" style="display: none;">
                <h2>How does the order process work?<i>.</i></h2>
                <div class="answer">
                    <p>Creating an account with us by placing your first order will give you a Telecommunications Business Package. All packages will include whichever wireless plans you select, as well as our powerful Business Cloud-phone system - ON US!<br>
                        <br> The process for getting started is as follows:<br>
                        <br> 1. Start off by going to the Plans page, either by clicking 'PLANS' on the top of the page, or from the homepage, by clicking 'EXPLORE PLANS'<br>
                        <br> 2. Next, look through the various wireless plans. They differ by price and amount of 4G LTE data. Meaning, all wireless plans include unlimited talk, text, and data, as well as all the other cool features. (See Mobility features
                        by clicking the 'WIRELESS MOBILITY FEATURES' link on the top of the Plans page.) The amount of 4G LTE - or "fast" - data is subject to the package you choose. However, after you run out of your allotted amount, you will be throttled
                        to slower speeds but still always be connected.<br>
                        <br> 3. Once you click 'Select' on the plan you want, a pop-up will appear. This pop-up will ask for some details, as well as offer you some features. Here is where you choose if you'll be bringing your own SIM card or getting
                        the special 3-in-1 SIM from us. You will also tell us if you're porting a number from another carrier, or if not, you'll be able to enter a desired area code. You can also choose to opt-in to some of the cool add-on features like
                        Stateside International Calling, and Name ID. There are optional features. When you're ready click 'ADD THIS PLAN' on the right.<br>
                        <br> 4. At this point you will be brought back to the Plans page. You will notice the plan you just selected in your cart on the right. At this point you have the option to add another line to your order by selecting another wireless
                        plan and repeating the same steps, or click 'NEXT STEP' on the right, at the bottom of your cart. <br>
                        <br> 5. At this point you need to verify your business. Fill in your business information, and upload the necessary documents. When you're ready, click 'NEXT STEP' or 'VERIFY MY BUSINESS'. Your information will be submitted and
                        one of our team members will verify your business. Don't worry, once you're verified your order will still be in your cart. If accepted, you should receive an email from us within an hour, with a link to proceed with your order.<br>
                        <br> 6. Once verified, you will receive an email with a link that will re-direct you to the next step in placing your order. Click 'NEXT STEP' on the right-hand side to continue. On the next page, create a password and 4-digit
                        PIN. The password will be used for you to login to your online account, and the PIN will be used whenever you want to make changes to your account by phone, by chat, or by email. Further on the same page you will enter your personal
                        information including billing and shipping info. When you’re ready, click ‘Next Step’.<br>
                        <br> 7. On the next page you will be able to review your order, and edit your cart. You can choose to add a line, or change some details on an existing line. You can also enter a discount code if you have one. Further down the
                        page you will enter your credit card info, and when you’ve done that you can click ‘PLACE ORDER’. (Please note, by placing your order, you agree to Teltik's privacy notice and conditions of use.)<br>
                        <br> 8. Your first order has now been placed. You will receive a confirmation email shortly after. The email will also include information on how to setup your cloud-based phone system. <br>
                        <br> Welcome aboard!<br>
                    </p>
                </div>
            </li>
            <li data-category="6" style="display: none;">
                <h2>Will Teltik work with my business as its needs grow?<i>.</i></h2>
                <div class="answer">
                    <p>Absolutely! We strive to create affordable plans to ensure that your company's communication strategy is scalable and always affordable. Give us a try.</p>
                </div>
            </li>
            <li data-category="6" style="display: none;">
                <h2>Is there access to MyT-Mobile?<i>.</i></h2>
                <div class="answer">
                    <p>Not at this time. All your billing, and account information can be found in your account portal on www.teltik.com.</p>
                </div>
            </li>
            <li data-category="6" style="display: none;">
                <h2>How do I make a payment online?<i>.</i></h2>
                <div class="answer">
                    <p>First, log in to your account using your email address and password, then click "Make Payment" on the left. When you process a payment, the credit card that you used when service was initially established, or the last credit card that
                        was used on the account will get charged. You can also update the credit card on file by clicking "Edit Billing Preferences" and entering it there. <br>
                        <br> Avoid having to manually login and make a payment, or interruption of service due to late payment, by using our "AutoPay" feature on the billing preferences page, and the monthly payment will be pulled each month automatically.
                        When enrolled in AutoPay, your payment will be pulled two days before it is due, to leave room for error and avoid interruption of service. (Please note: If you enroll in AutoPay within two days of your billing due date, it will
                        not pull on the upcoming bill, and only take effect in the following one.)<br>
                        <br>
                    </p>
                </div>
            </li>
            <li data-category="6" style="display: none;">
                <h2>How to enable International Roaming?<i>.</i></h2>
                <div class="answer">
                    <p>International Roaming is disabled on all voice lines, but enabled on all data-only lines. <br>
                        <br> In order to enable International Roaming on your voice line, please send us an email to support@teltik.com with your phone number and request. We will respond shortly after with the International Roaming Terms. Once you respond
                        with your consent, we will enable International Roaming on your line.<br>
                        <br> International Roaming cannot be enabled within the first 30 days of service.<br>
                        <br> For more details about this feature, please see FAQ titled "All I need to know about international roaming."</p>
                </div>
            </li>
            <li data-category="6" style="display: none;">
                <h2>How do I upgrade or downgrade my plan?<i>.</i></h2>
                <div class="answer">
                    <p>Upgrading and downgrading plans as well as adding or removing features is really simple.<br>
                        <br> 1. Click sign in<br> 2. Log in with your credentials<br> 3. Under Monthly Billing, locate the phone number that you would like to change the plan for.<br> 4. Click the drop down on the right hand side of that number<br> 5.
                        Select the 'Change my plan' option<br> 6. Continue through the steps as prompted <br>
                        <br> If upgrading, the new plan will be applied to that line. The change will take effect within several hours. In addition, your card on file will get charged the price difference for the upgrade added. For example, if you are
                        on the $25 plan, your billing cycle is on the 1st of the month, and on the 15th you upgrade to the $30 plan, the difference is $5. You will be charged the entire difference, which will cover you until the end of the month. Upon
                        the next billing cycle, you will get charged the new rate.<br>
                        <br> If downgrading, the effect will only take place at the beginning of the next upcoming billing cycle, at which point you will be charged the new rate.</p>
                </div>
            </li>
            <li data-category="6" style="display: none;">
                <h2>How can I see how much data I have used this month?<i>.</i></h2>
                <div class="answer">
                    <p>Simply dial code #932# and your phone will show you how much data you have used. Please remember that music streaming from included platforms DO NOT count against your data usage and are therefore not included in this tally.</p>
                </div>
            </li>
            <li data-category="6" style="display: none;">
                <h2>Should I call my current carrier to cancel service once I have placed an order?<i>.</i></h2>
                <div class="answer">
                    <p>NO! DO NOT call your current carrier to cancel until AFTER your number has been ported successfully. </p>
                </div>
            </li>
            <li data-category="6" style="display: none;">
                <h2>I ported my number and it's not working<i>.</i></h2>
                <div class="answer">
                    <p>Porting over a new number can take up to 24 hours to go though fully. Time of porting will depend on how long it takes for the other carrier to release the line. Lines coming from one of the big carriers are usually released immediately.
                        Port-ins from landlines can take up to 2 weeks although they usually go through much sooner. Turning off the phone with the old provider could help as well.<br>
                        <br> If the issues persists please get in touch with us by phone or email. support@teltik.com - 888­ 406 2838</p>
                </div>
            </li>
            <li data-category="6" style="display: none;">
                <h2>How do I port out of Teltik?<i>.</i></h2>
                <div class="answer">
                    <p>We are sad to see you go, but porting out is simple.<br>
                        <br> Send an email to support@teltik.com with your request to port out. Please be sure to include your name, 4-digit PIN, the number you would like to port out, and the carrier that you are porting out to. Please note that your
                        line must be active and paid up to port out. Lines can take 48 hours to be released before porting out.<br>
                        <br> If you are looking to move over to your own account with T-Mobile, then please request a Change of Responsibility in your email to support.<br>
                        <br> Do NOT try porting out your number before we have supplied you with the account number and PIN and ensured that your line has been released, as we will be unable to release your line. If you have submitted a port request with
                        your other carrier before being ensured that your line is released, then you must have the carrier cancel the port request before we release your line.</p>
                </div>
            </li>
            <li data-category="6" style="display: none;">
                <h2>Is there anything else I can be charged for?<i>.</i></h2>
                <div class="answer">
                    <p>Ideally, no. However, there are some cases in which you as the end user will be responsible for extra charges.<br>
                        <br> Your card on file will automatically be charged for usage of services that are not included in your plan, including, but not limited to, the following: <br> 1) Calls to the Virgin Islands, or any international destination
                        with a +1 prefix, other than Canada (approx. $3.00/min, plus 5% covering taxes and fees, should you not have the Stateside International Calling plan).<br> 2) Calls from Canada to Mexico, or vice versa (approx. $3.00/min, plus
                        5% covering taxes and fees, should you not have the Stateside International Calling plan).<br> 3) Calls to 411 ($1.99/call. plus 5% covering taxes and fees).<br> 4) International voice roaming, including using voicemail while international
                        ($0.35/minute)<br> 5) Calling any out-of-plan phone numbers, services like chat lines, conference calls, and radio broadcast lines ($0.01/minute, plus 5% covering taxes and fees)<br> 6) Downloading apps and usage of services (such
                        as name ID or Rhapsody).<br> 7) Talk, text, or data usage while on a cruise or ferry (rates vary by cruise and destination, plus 5% covering taxes and fees).</p>
                </div>
            </li>
            <li data-category="6" style="display: none;">
                <h2>How to enable HD video?<i>.</i></h2>
                <div class="answer">
                    <p>The following plans allow HD video streaming: TeltikOne Plus ($50), TeltikOne Plus International ($65), TabletOne Plus ($40), and the TabletOne Plus International ($55). However, they need to be enabled on your end. Here is the lowdown
                        on how to do it:<br>
                        <br> 1. Open the T-Mobile app.<br> 2. Select Profile Settings in the top-right corner.<br> 3. Select Media Settings.<br> 4. To the right of HD Video Resolution, slide the toggle to turn it ON.</p>
                </div>
            </li>
            <li data-category="6" style="display: none;">
                <h2>When does my data reset?<i>.</i></h2>
                <div class="answer">
                    <p>Great question! Your billing cycle date and data reset date are not necessarily the same day. Your billing cycle date - the day your bill is due every month, will always be the day of the month on which you placed your first order.
                        Your data reset date, however, is on the 11th of every month. </p>
                </div>
            </li>
            <li data-category="5" style="display: none;">
                <h2>Should I call my current carrier to cancel service once I have placed an order?<i>.</i></h2>
                <div class="answer">
                    <p>NO! DO NOT call your current carrier to cancel until AFTER your number has been ported successfully. </p>
                </div>
            </li>
            <li data-category="5" style="display: none;">
                <h2>How do I port out of Teltik?<i>.</i></h2>
                <div class="answer">
                    <p>We are sad to see you go, but porting out is simple.<br>
                        <br> Send an email to support@teltik.com with your request to port out. Please be sure to include your name, 4-digit PIN, the number you would like to port out, and the carrier that you are porting out to. Please note that your
                        line must be active and paid up to port out. Lines can take 48 hours to be released before porting out.<br>
                        <br> If you are looking to move over to your own account with T-Mobile, then please request a Change of Responsibility in your email to support.<br>
                        <br> Do NOT try porting out your number before we have supplied you with the account number and PIN and ensured that your line has been released, as we will be unable to release your line. If you have submitted a port request with
                        your other carrier before being ensured that your line is released, then you must have the carrier cancel the port request before we release your line.</p>
                </div>
            </li>
            <li data-category="5" style="display: none;">
                <h2>I ported my number and it's not working<i>.</i></h2>
                <div class="answer">
                    <p>Porting over a new number can take up to 24 hours to go though fully. Time of porting will depend on how long it takes for the other carrier to release the line. Lines coming from one of the big carriers are usually released immediately.
                        Port-ins from landlines can take up to 2 weeks although they usually go through much sooner. Turning off the phone with the old provider could help as well.<br>
                        <br> If the issues persists please get in touch with us by phone or email. support@teltik.com - 888­ 406 2838</p>
                </div>
            </li>
            <li data-category="5" style="display: none;">
                <h2>Can I keep my number or bring my number over from my current carrier?<i>.</i></h2>
                <div class="answer">
                    <p>YES, you can port in from just about any carrier, as long as it is not coming from T-Mobile, and porting is free! <br>
                        <br> First, be sure to check its portability by clicking <a href="http://www.t-mobile.com/switch/">HERE</a> to ensure you can bring it over.<br>
                        <br> Once you receive your sim card, you will fill out the NUMBER PORTING FORM which is processed within 24 hours. You may port in a number from virtually any carrier in the nation except from T-Mobile itself. You should not have
                        any down-time as the actual transfer is instant.<br>
                        <br> Here is a detailed rundown of the porting process, it's pretty easy:<br> 1. Log into your account by clicking “Sign In” on the top of the Teltik.com page and click the "Monthly Billing" tab<br> 2. Locate the line you would
                        like to have ported and click on the arrow<br> 3. In the drop down, click "port my number"<br> 4. It will ask you to complete the following fields and fill in the rest. A) Authorized Name B) Address (include city, state, and ZIP)
                        C) The account number of your current carrier D) The (PIN) of your current carrier <br>
                        <br> Ports are processed on our end within 24 hours. Time of porting will depend on how long it takes for the other carrier to release the line. Lines coming from one of the big carriers are usually released immediately. Port-ins
                        from landlines can take up to 2 weeks although they usually go through much sooner.<br>
                        <br> Click <a href="http://www.prepaidphonenews.com/2014/02/porting-your-number-how-to-find-your.html">HERE</a> to see an informative link which details how to locate your account number and PIN from your current carrier.</p>
                </div>
            </li>
            <li data-category="4" style="">
                <h2>These plans seem too good to be true, how is this possible?<i>.</i></h2>
                <div class="answer">
                    <p>We like your thinking! We have opted to eliminate multi-million dollar marketing campaigns in favor of passing those savings on to you. You like it? Pass it onto your colleagues so that they can join the fun too. In addition, Teltik
                        is a T-Mobile Business re-seller that focuses on delivering high value services to its network.<br>
                        <br>
                    </p>
                </div>
            </li>
            <li data-category="4" style="">
                <h2>Can I keep my number or bring my number over from my current carrier?<i>.</i></h2>
                <div class="answer">
                    <p>YES, you can port in from just about any carrier, as long as it is not coming from T-Mobile, and porting is free! <br>
                        <br> First, be sure to check its portability by clicking <a href="http://www.t-mobile.com/switch/">HERE</a> to ensure you can bring it over.<br>
                        <br> Once you receive your sim card, you will fill out the NUMBER PORTING FORM which is processed within 24 hours. You may port in a number from virtually any carrier in the nation except from T-Mobile itself. You should not have
                        any down-time as the actual transfer is instant.<br>
                        <br> Here is a detailed rundown of the porting process, it's pretty easy:<br> 1. Log into your account by clicking “Sign In” on the top of the Teltik.com page and click the "Monthly Billing" tab<br> 2. Locate the line you would
                        like to have ported and click on the arrow<br> 3. In the drop down, click "port my number"<br> 4. It will ask you to complete the following fields and fill in the rest. A) Authorized Name B) Address (include city, state, and ZIP)
                        C) The account number of your current carrier D) The (PIN) of your current carrier <br>
                        <br> Ports are processed on our end within 24 hours. Time of porting will depend on how long it takes for the other carrier to release the line. Lines coming from one of the big carriers are usually released immediately. Port-ins
                        from landlines can take up to 2 weeks although they usually go through much sooner.<br>
                        <br> Click <a href="http://www.prepaidphonenews.com/2014/02/porting-your-number-how-to-find-your.html">HERE</a> to see an informative link which details how to locate your account number and PIN from your current carrier.</p>
                </div>
            </li>
            <li data-category="4" style="">
                <h2>Can I keep my current device that I have now?<i>.</i></h2>
                <div class="answer">
                    <p>YES! As long as the device is T-Mobile branded, or GSM unlocked (bands compatible with T-Mobile), you can use it on our network. To unlock your device simply contact your current carrier or visit <a href="http://bit.ly/x_teltikcomms">DoctorSIM</a>                        which does a great job at unlocking just about ANY device at great prices along with solid support. Check them out by clicking <a href="http://bit.ly/x_teltikcomms">Here</a>.</p>
                </div>
            </li>
            <li data-category="4" style="">
                <h2>Is there a contract, or do I need to sign a contract to get this plan?<i>.</i></h2>
                <div class="answer">
                    <p>NO! There is NO LONG TERM CONTRACT and only pre-pay for 30 days. YOU ARE FREE TO CANCEL ANYTIME! If you cancel mid-month, there are no prorated refunds though.</p>
                </div>
            </li>
            <li data-category="4" style="">
                <h2>How do I sign up?<i>.</i></h2>
                <div class="answer">
                    <p>Simply go to the homepage or teltik.com and click Explore Plans and go through our easy checkout. You will see how much you will be billed each month including tax. Welcome aboard!<br>
                        <br> Please see ‘How does the order process work?’ for a more detailed breakdown.</p>
                </div>
            </li>
            <li data-category="4" style="">
                <h2>Is the T-Mobile unlimited music streaming included?<i>.</i></h2>
                <div class="answer">
                    <p>Yes! <br>
                        <br> You will have access to T-Mobile's Music Freedom feature. Stream as much music as you want on your smartphone from top streaming services, and it won’t count towards your 4G LTE data plan. Data charges do not apply! Please
                        note however, that access to the actual music streaming services are NOT included, rather just that the data which they use will not count towards your high speed data allotment of your plan. <br>
                        <br> Click <a href="https://www.t-mobile.com/offer/free-music-streaming.html">HERE</a> to review the list of approved streaming services.</p>
                </div>
            </li>
            <li data-category="4" style="">
                <h2>Will Teltik work with my business as its needs grow?<i>.</i></h2>
                <div class="answer">
                    <p>Absolutely! We strive to create affordable plans to ensure that your company's communication strategy is scalable and always affordable. Give us a try.</p>
                </div>
            </li>
            <li data-category="4" style="">
                <h2>Who are these plans for?<i>.</i></h2>
                <div class="answer">
                    <p>Teltik, an official T-Mobile business re-seller created plans that target businesses, entrepreneurs, and sole proprietors bringing them over to the powerful T-Mobile network, and giving them a cloud-based phone system that is easy
                        to use and gives your company a professional look.</p>
                </div>
            </li>
            <li data-category="4" style="">
                <h2>How can I see how much data I have used this month?<i>.</i></h2>
                <div class="answer">
                    <p>Simply dial code #932# and your phone will show you how much data you have used. Please remember that music streaming from included platforms DO NOT count against your data usage and are therefore not included in this tally.</p>
                </div>
            </li>
            <li data-category="4" style="">
                <h2>Is there access to MyT-Mobile?<i>.</i></h2>
                <div class="answer">
                    <p>Not at this time. All your billing, and account information can be found in your account portal on www.teltik.com.</p>
                </div>
            </li>
            <li data-category="4" style="">
                <h2>Short codes, what are my options? <i>.</i></h2>
                <div class="answer">
                    <p>Third party billing is blocked as much as possible to protect your account. Many clients have successfully been using Google Voice to receive short code messages and this has been working well for them. Should you accrue any third
                        party charges, they will be added to your account + 5% covering taxes and fees, and automatically charged on your next invoice.</p>
                </div>
            </li>
            <li data-category="4" style="">
                <h2>Is the T-Mobile unlimited video streaming included?<i>.</i></h2>
                <div class="answer">
                    <p>Yes!<br>
                        <br> All qualifying plans - with 3GB or more - can also take advantage of the unlimited video streaming and it won’t count towards your 4G LTE data. Data charges do not apply! Please note however, that access to the actual video
                        streaming services are NOT included, rather just that the data which they use will not count towards your high speed data allotment of your plan. <br>
                        <br> Click <a href="https://www.t-mobile.com/offer/binge-on-streaming-video.html">HERE</a> to review the list of approved streaming services.<br>
                        <br> Ensure your BingeOn is enabled by checking the status, dial #BNG# (#264#) from your phone. To turn on dial #BON# (#266#), and to turn off dial #BOF# (#263#)</p>
                </div>
            </li>
            <li data-category="4" style="">
                <h2>What happens if I miss a payment?<i>.</i></h2>
                <div class="answer">
                    <p>Our plans are prepaid, which means you pay ahead of the coming month. Should payment not be made, the line will be temporarily suspended until payment is made. After 14 days of no payment, the line will be closed permanently, which
                        can result in the loss of the phone number. </p>
                </div>
            </li>
            <li data-category="4" style="">
                <h2>How do I make a payment online?<i>.</i></h2>
                <div class="answer">
                    <p>First, log in to your account using your email address and password, then click "Make Payment" on the left. When you process a payment, the credit card that you used when service was initially established, or the last credit card that
                        was used on the account will get charged. You can also update the credit card on file by clicking "Edit Billing Preferences" and entering it there. <br>
                        <br> Avoid having to manually login and make a payment, or interruption of service due to late payment, by using our "AutoPay" feature on the billing preferences page, and the monthly payment will be pulled each month automatically.
                        When enrolled in AutoPay, your payment will be pulled two days before it is due, to leave room for error and avoid interruption of service. (Please note: If you enroll in AutoPay within two days of your billing due date, it will
                        not pull on the upcoming bill, and only take effect in the following one.)</p>
                </div>
            </li>
            <li data-category="4" style="">
                <h2>How do I upgrade or downgrade my plan?<i>.</i></h2>
                <div class="answer">
                    <p>Upgrading and downgrading plans as well as adding or removing features is really simple.<br>
                        <br> 1. Click sign in<br> 2. Log in with your credentials<br> 3. Under Monthly Billing, locate the phone number that you would like to change the plan for.<br> 4. Click the drop down on the right hand side of that number<br> 5.
                        Select the 'Change my plan' option<br> 6. Continue through the steps as prompted <br>
                        <br> If upgrading, the new plan will be applied to that line. The change will take effect within several hours. In addition, your card on file will get charged the price difference for the upgrade added. For example, if you are
                        on the $25 plan, your billing cycle is on the 1st of the month, and on the 15th you upgrade to the $30 plan, the difference is $5. You will be charged the entire difference, which will cover you until the end of the month. Upon
                        the next billing cycle, you will get charged the new rate.<br>
                        <br> If downgrading, the effect will only take place at the beginning of the next upcoming billing cycle, at which point you will be charged the new rate.</p>
                </div>
            </li>
            <li data-category="4" style="">
                <h2>What is the business Cloud-Phone?<i>.</i></h2>
                <div class="answer">
                    <p>With your Teltik business package, you get an iPlum account free of charge! Your iPlum account will allow you to enhance your image with a dedicated business number that works across multiple devices, anywhere in the world. <br>
                        <br> The system we offer is cloud based, which means it's hosted and stored on the internet.<br>
                        <br> You will get 10 iPlum Credits a month for free. Credits are used by making and taking calls, as well as sending and receiving messages. Calls are one Credit per minute, and text message are one Credit per message. Additional
                        Credits are available for purchase from iPlum directly. </p>
                </div>
            </li>
            <li data-category="4" style="">
                <h2>How does the order process work?<i>.</i></h2>
                <div class="answer">
                    <p>Creating an account with us by placing your first order will give you a Telecommunications Business Package. All packages will include whichever wireless plans you select, as well as our powerful Business Cloud-phone system - ON US!<br>
                        <br> The process for getting started is as follows:<br>
                        <br> 1. Start off by going to the Plans page, either by clicking 'PLANS' on the top of the page, or from the homepage, by clicking 'EXPLORE PLANS'<br>
                        <br> 2. Next, look through the various wireless plans. They differ by price and amount of 4G LTE data. Meaning, all wireless plans include unlimited talk, text, and data, as well as all the other cool features. (See Mobility features
                        by clicking the 'WIRELESS MOBILITY FEATURES' link on the top of the Plans page.) The amount of 4G LTE - or "fast" - data is subject to the package you choose. However, after you run out of your allotted amount, you will be throttled
                        to slower speeds but still always be connected.<br>
                        <br> 3. Once you click 'Select' on the plan you want, a pop-up will appear. This pop-up will ask for some details, as well as offer you some features. Here is where you choose if you'll be bringing your own SIM card or getting
                        the special 3-in-1 SIM from us. You will also tell us if you're porting a number from another carrier, or if not, you'll be able to enter a desired area code. You can also choose to opt-in to some of the cool add-on features like
                        Stateside International Calling, and Name ID. There are optional features. When you're ready click 'ADD THIS PLAN' on the right.<br>
                        <br> 4. At this point you will be brought back to the Plans page. You will notice the plan you just selected in your cart on the right. At this point you have the option to add another line to your order by selecting another wireless
                        plan and repeating the same steps, or click 'NEXT STEP' on the right, at the bottom of your cart. <br>
                        <br> 5. At this point you need to verify your business. Fill in your business information, and upload the necessary documents. When you're ready, click 'NEXT STEP' or 'VERIFY MY BUSINESS'. Your information will be submitted and
                        one of our team members will verify your business. Don't worry, once you're verified your order will still be in your cart. If accepted, you should receive an email from us within an hour, with a link to proceed with your order.<br>
                        <br> 6. Once verified, you will receive an email with a link that will re-direct you to the next step in placing your order. Click 'NEXT STEP' on the right-hand side to continue. On the next page, create a password and 4-digit
                        PIN. The password will be used for you to login to your online account, and the PIN will be used whenever you want to make changes to your account by phone, by chat, or by email. Further on the same page you will enter your personal
                        information including billing and shipping info. When you’re ready, click ‘Next Step’.<br>
                        <br> 7. On the next page you will be able to review your order, and edit your cart. You can choose to add a line, or change some details on an existing line. You can also enter a discount code if you have one. Further down the
                        page you will enter your credit card info, and when you’ve done that you can click ‘PLACE ORDER’. (Please note, by placing your order, you agree to Teltik's privacy notice and conditions of use.)<br>
                        <br> 8. Your first order has now been placed. You will receive a confirmation email shortly after. The email will also include information on how to setup your cloud-based phone system. <br>
                        <br> Welcome aboard!</p>
                </div>
            </li>
            <li data-category="4" style="">
                <h2>What if I need more High-Speed data?<i>.</i></h2>
                <div class="answer">
                    <p>You can easily upgrade your plan in your account portal. Your upgraded data should apply within 12 hours. <br>
                        <br> See 'How do I upgrade or downgrade my plan?' for details on how to get this done.</p>
                </div>
            </li>
            <li data-category="4" style="">
                <h2>When will my SIM card get shipped?<i>.</i></h2>
                <div class="answer">
                    <p>SIM cards are shipped out the same business day, providing the order is placed before 1:30PM. During holidays and weekends, shipments will be sent out within 48 hours. <br>
                        <br> SIM cards are shipped via USPS. However, if you are trying to "time" your order to coincide with the end of a billing cycle, give yourself a little leeway so that there is no lapse in service. If porting, ensure that you have
                        enough time to receive your SIM and port your number over before your current carriers billing cycle is up. Porting out of a inactive account is blocked by many carriers. <br>
                        <br> Once shipped, you will receive a tracking number via email.<br>
                    </p>
                </div>
            </li>
            <li data-category="4" style="">
                <h2>Can I activate my own T-Mobile SIM card with your service?<i>.</i></h2>
                <div class="answer">
                    <p>Great question! The choice is yours. You may either purchase a SIM card though Teltik, or you may bring your own SIM.<br>
                        <br> Please note: Should you choose to bring your own SIM, it MUST meet the following two criteria:<br>
                        <br> 1. It MUST be T-Mobile branded (not co-branded/MVNO)<br> 2. It MUST be new and unused. <br>
                        <br> The SIM card will not work if these conditions are not met.<br>
                        <br> The option to choose whether to use your own SIM or purchase one through Teltik is asked during signup.</p>
                </div>
            </li>
            <li data-category="4" style="">
                <h2>Is my data really always unlimited?<i>.</i></h2>
                <div class="answer">
                    <p>Yes. Your data will never be cut off. <br>
                        <br> All our plans include UNLIMITED talk, text, and data. However, amount of 4G LTE - High-speed data is subject to the package you choose. After you run out of your allotted amount, you will be throttled to slower speeds but
                        still be connected.<br>
                        <br> For the Unlimited LTE plans, you get unlimited 4G LTE - High-speed data. However, during times of congestion, it is subject to network deprioritization (currently estimated at approximately 50GB). <br>
                        <br> To explain, if you use more than 50GB of data in one cycle, your data usage will be prioritized below others for the remainder of that data cycle. The only time that you’re likely to see the effects of that, though, is when
                        you’re at a location on the network that is congested, during which time you may see slower speeds. Once you move to a different location or the congestion goes down, your speeds will likely go back up. And once the new data cycle
                        rolls around, your usage will be reset.</p>
                </div>
            </li>
            <li data-category="4" style="">
                <h2>Is there anything else I can be charged for?<i>.</i></h2>
                <div class="answer">
                    <p>Ideally, no. However, there are some cases in which you as the end user will be responsible for extra charges.<br>
                        <br> Your card on file will automatically be charged for usage of services that are not included in your plan, including, but not limited to, the following: <br> 1) Calls to the Virgin Islands, or any international destination
                        with a +1 prefix, other than Canada (approx. $3.00/min, plus 5% covering taxes and fees, should you not have the Stateside International Calling plan).<br> 2) Calls from Canada to Mexico, or vice versa (approx. $3.00/min, plus
                        5% covering taxes and fees, should you not have the Stateside International Calling plan).<br> 3) Calls to 411 ($1.99/call. plus 5% covering taxes and fees).<br> 4) International voice roaming, including using voicemail while international
                        ($0.35/minute)<br> 5) Calling any out-of-plan phone numbers, services like chat lines, conference calls, and radio broadcast lines ($0.01/minute, plus 5% covering taxes and fees)<br> 6) Downloading apps and usage of services (such
                        as name ID or Rhapsody).<br> 7) Talk, text, or data usage while on a cruise or ferry (rates vary by cruise and destination, plus 5% covering taxes and fees).</p>
                </div>
            </li>
            <li data-category="4" style="">
                <h2>Does the HD video need to be enabled?<i>.</i></h2>
                <div class="answer">
                    <p>Yes, some plans that include HD video streaming, need to be enabled manually. <br>
                        <br> The following plans allow HD video streaming, and need to be enabled on your end: TeltikOne Plus ($50), TeltikOne Plus International ($65), TabletOne Plus ($40), and the TabletOne Plus International ($55). Here is the lowdown
                        on how to do it:<br>
                        <br> 1. Open the T-Mobile app.<br> 2. Select Profile Settings in the top-right corner.<br> 3. Select Media Settings.<br> 4. To the right of HD Video Resolution, slide the toggle to turn it ON.</p>
                </div>
            </li>
            <li data-category="4" style="">
                <h2>When does my data reset?<i>.</i></h2>
                <div class="answer">
                    <p>Great question! Your billing cycle date and data reset date are not necessarily the same day. Your billing cycle date - the day your bill is due every month, will always be the day of the month on which you placed your first order.
                        Your data reset date, however, is on the 11th of every month. </p>
                </div>
            </li>
            <li data-category="4" style="">
                <h2>Will I have service in Canada?<i>.</i></h2>
                <div class="answer">
                    <p>Yes! All our plans include service in Canada. You can also use your phone to call numbers in Canada from US, at no extra cost!<br>
                        <br> Service in Canada will work as it does in the US with unlimited talk, text and data. High-speed data in Canada will be capped at 5GB. After 5GB of high-speed data is used (or your high-speed data allotment is reached, whichever
                        comes first), you will stay connected with unlimited data at up to 128kbps (or 256kbps with TeltikOne Plus). <br>
                        <br> The OnePlus International plans, on voice lines and tablets, will have unlimited 4G LTE with no cap.</p>
                </div>
            </li>
            <li data-category="1" style="display: none;">
                <h2>Is there domestic roaming available? <i>.</i></h2>
                <div class="answer">
                    <p>Yes, our service includes free domestic roaming across the United States, which includes 200MB for data use. You will also receive a text once you reach 80% of your domestic roaming data, and another when you reach 100%</p>
                </div>
            </li>
            <li data-category="1" style="display: none;">
                <h2>How to enable International Roaming?<i>.</i></h2>
                <div class="answer">
                    <p>International Roaming is disabled on all voice lines, but enabled on all data-only lines. <br>
                        <br> In order to enable International Roaming on your voice line, please send us an email to support@teltik.com with your phone number and request. We will respond shortly after with the International Roaming Terms. Once you respond
                        with your consent, we will enable International Roaming on your line.<br>
                        <br> International Roaming cannot be enabled within the first 30 days of service.<br>
                        <br> For more details about this feature, please see FAQ titled "All I need to know about international roaming."</p>
                </div>
            </li>
            <li data-category="1" style="display: none;">
                <h2>All I need to know about International Roaming<i>.</i></h2>
                <div class="answer">
                    <p>International Roaming is disabled on all voice lines, and is available upon request. Data-only lines are enabled by default. <br>
                        <br> In order to enable International Roaming please send us a request to support@teltik.com and we will respond shortly after with the International Roaming Terms. Once you respond with your consent, we will enable International
                        Roaming on your line.<br>
                        <br> International Roaming cannot be enabled within the first 30 days of service.<br>
                        <br> Please note that data and text is free in the included countries (see list of countries below). In addition, calls made through WiFi Calling back to the US only, are free as well.<br>
                        <br> However, calls made over CELLULAR connection while roaming outside the US or Canada, including incoming and outgoing calls, as well as voicemail retrieval, are not free and will be charged $0.35 per minute.<br>
                        <br> International Roaming will be enabled for a period of 30 days. If you plan to make frequent trips abroad and would like it enabled for a longer period of time, please let us know.<br>
                        <br> For support while roaming, call T-Mobile's International Support desk. Dial +1-505-998-3793 (this is a FREE call from your T-Mobile phone) or 001-505-998-3793 (from a land-line).<br>
                        <br> Please note: International Roaming includes voice, text and data. However, even when this feature is enabled, it will only work in certain countries and certain parts of the world. There are places throughout the world that
                        International Roaming will work, but at an additional charge. So before enabling this feature, be sure to check the coverage at your destination by clicking <a href="https://www.t-mobile.com/coverage/roaming">HERE</a>. Coverage
                        on a cruise or ferry are not included either, and exact rates can be found using the same link.<br>
                        <br> ---
                        <br>
                        <br> Automatic coverage in over 210 countries and destinations.<br>
                        <br> Unlimited international data coverage and texting are included with all plans at no additional charge. It's just 35 cents per minute for calls to mobile devices and landlines, as well as voicemail retrieval.<br>
                        <br> Afghanistan
                        <br> Aland Islands<br> Albania
                        <br> Alderney
                        <br> Algeria
                        <br> Andorra
                        <br> Angola
                        <br> Anguilla
                        <br> Antigua and Barbuda<br> Argentina
                        <br> Armenia
                        <br> Aruba
                        <br> Australia
                        <br> Austria
                        <br> Azerbaijan
                        <br> Azores
                        <br> Bahamas
                        <br> Bahrain
                        <br> Bangladesh
                        <br> Barbados
                        <br> Belarus
                        <br> Belgium
                        <br> Belize
                        <br> Benin
                        <br> Bermuda
                        <br> Bolivia
                        <br> Bonaire
                        <br> Bosnia and Herzegovina<br> Brazil
                        <br> British Virgin Islands<br> Brunei Darussalam<br> Bulgaria
                        <br> Burkina Faso<br> Burundi
                        <br> Cambodia
                        <br> Cameroon
                        <br> Canada
                        <br> Canary Islands<br> Cape Verde<br> Cayman Islands<br> Chad
                        <br> Chile
                        <br> China
                        <br> Christmas Island<br> Colombia
                        <br> Congo
                        <br> Congo, Democratic Republic<br> Costa Rica<br> Cote d'Ivoire<br> Croatia
                        <br> Curacao
                        <br> Cyprus
                        <br> Czech Republic<br> Denmark
                        <br> Dominica
                        <br> Dominican Republic<br> Easter Island<br> Ecuador
                        <br> Egypt
                        <br> El Salvador<br> Estonia
                        <br> Faroe Islands<br> Fiji
                        <br> Finland
                        <br> France
                        <br> French Guiana<br> French Polynesia<br> Gabon
                        <br> Gambia
                        <br> Georgia
                        <br> Germany
                        <br> Ghana
                        <br> Gibraltar
                        <br> Greece
                        <br> Greenland
                        <br> Grenada
                        <br> Guadeloupe
                        <br> Guam
                        <br> Guatemala
                        <br> Guernsey
                        <br> Guinea
                        <br> Guinea-Bissau
                        <br> Guyana
                        <br> Haiti
                        <br> Herm
                        <br> Honduras
                        <br> Hong Kong<br> Hungary
                        <br> Iceland
                        <br> India
                        <br> Indonesia
                        <br> Iraq
                        <br> Ireland
                        <br> Isle of Man<br> Israel
                        <br> Italy
                        <br> Jamaica
                        <br> Japan
                        <br> Jersey
                        <br> Jordan
                        <br> Kazakhstan
                        <br> Kenya
                        <br> Kosovo
                        <br> Kuwait
                        <br> Kyrgyzstan
                        <br> Laos
                        <br> Latvia
                        <br> Liberia
                        <br> Lichtenstein
                        <br> Lithuania
                        <br> Luxembourg
                        <br> Macau
                        <br> Macedonia
                        <br> Madagascar
                        <br> Madeira
                        <br> Malawi
                        <br> Malaysia
                        <br> Maldives
                        <br> Mali
                        <br> Malta
                        <br> Marie Galante<br> Martinique
                        <br> Mauritania
                        <br> Mauritius
                        <br> Mayotte
                        <br> Mexico
                        <br> Moldova
                        <br> Monaco
                        <br> Mongolia
                        <br> Montenegro
                        <br> Montserrat
                        <br> Morocco
                        <br> Mozambique
                        <br> Myanmar
                        <br> Nauru
                        <br> Netherlands
                        <br> Netherlands Antilles<br> New Zealand<br> Nicaragua
                        <br> Niger
                        <br> Nigeria
                        <br> Northern Ireland<br> Northern Mariana Islands (Saipan)<br> Norway
                        <br> Oman
                        <br> Pakistan
                        <br> Palestinian Territories<br> Panama
                        <br> Papua New Guinea<br> Paraguay
                        <br> Peru
                        <br> Philippines
                        <br> Poland
                        <br> Portugal
                        <br> Qatar
                        <br> Reunion
                        <br> Romania
                        <br> Russia
                        <br> Rwanda
                        <br> Saint Barthelemy<br> Saint Eustatius<br> Saint Kitts and Nevis<br> Saint Lucia<br> Saint Martin<br> Saint Saba<br> Saint Vincent and the Grenadines<br> Samoa
                        <br> San Marino<br> Sark Island<br> Saudi Arabia<br> Scotland
                        <br> Senegal
                        <br> Serbia
                        <br> Seychelles
                        <br> Sierra Leone<br> Singapore
                        <br> Sint Maarten<br> Slovakia
                        <br> Slovenia
                        <br> South Africa<br> South Korea<br> Spain
                        <br> Sri Lanka<br> Suriname
                        <br> Svalbard
                        <br> Sweden
                        <br> Switzerland
                        <br> Taiwan
                        <br> Tajikistan
                        <br> Tanzania
                        <br> Thailand
                        <br> Togo
                        <br> Tonga
                        <br> Trinidad and Tobago<br> Tunisia
                        <br> Turkey
                        <br> Turkmenistan
                        <br> Turks and Caicos Islands<br> Uganda
                        <br> Ukraine
                        <br> United Arab Emirates<br> United Kingdom<br> Uruguay
                        <br> Uzbekistan
                        <br> Vatican City<br> Venezuela
                        <br> Vietnam
                        <br> Wales
                        <br> Western Sahara<br> Zambia
                        <br> Zimbabwe
                        <br>
                        <br>
                        <br> Additional charges apply in excluded destinations; included destinations subject to change. Taxes additional; usage taxed in some countries. Voice and text features for direct communications between 2 people. Communications
                        with premium-rate (e.g., 900, entertainment, high-rate helpline) numbers not included and may incur additional charges. Calls over cellular while roaming outside of the USA will be charged at $0.35 per minute (no charge for Wi-Fi
                        calls to U.S.) Coverage not available in some areas; we are not responsible for the performance of roaming partners' networks. Standard speeds approx. 128 Kbps. No tethering.</p>
                </div>
            </li>
            <li data-category="1" style="display: none;">
                <h2>Will I have service in Canada?<i>.</i></h2>
                <div class="answer">
                    <p>Yes! All our plans include service in Canada. You can also use your phone to call numbers in Canada from US, at no extra cost!<br>
                        <br> Service in Canada will work as it does in the US with unlimited talk, text and data. High-speed data in Canada will be capped at 5GB. After 5GB of high-speed data is used (or your high-speed data allotment is reached, whichever
                        comes first), you will stay connected with unlimited data at up to 128kbps (or 256kbps with TeltikOne Plus). <br>
                        <br> The OnePlus International plans, on voice lines and tablets, will have unlimited 4G LTE with no cap.</p>
                </div>
            </li>
            <li data-category="3" style="display: none;">
                <h2>What is my Visual Voicemail default password?<i>.</i></h2>
                <div class="answer">
                    <p>Your default password is usually the last four digits of your phone number.</p>
                </div>
            </li>
            <li data-category="3" style="display: none;">
                <h2>I have cellular connection, but my internet isn't working<i>.</i></h2>
                <div class="answer">
                    <p>Ensure that your APN settings are correct by matching the information below:<br>
                        <br> Name: T-MOBILE<br> APN: fast.tmobile.com but if it’s not an LTE Device, use: epc.tmobile.com instead<br> Proxy:
                        <leave in="" blank=""><br> Port:
                            <leave in="" blank=""><br> Username:
                                <leave in="" blank=""><br> Password:
                                    <leave in="" blank=""><br> Server:
                                        <leave in="" blank=""><br> MMSC: http://mms.msg.eng.t-mobile.com/mms/wapenc<br> MMS proxy:
                                            <leave in="" blank=""><br> MMS port:
                                                <leave in="" blank=""><br> MCC: 310<br> MNC: 260<br> Authentication type:
                                                    <leave in="" blank=""><br> APN type: default,supl,mms<br> APN Protocol: Leave it to the Default one<br>
                                                        <br> If this did not resolve the issue, please get in touch with us and we will send out a network update for your line.</leave>
                                                </leave>
                                            </leave>
                                        </leave>
                                    </leave>
                                </leave>
                            </leave>
                        </leave>
                    </p>
                </div>
            </li>
            <li data-category="3" style="display: none;">
                <h2>Call Forwarding<i>.</i></h2>
                <div class="answer">
                    <p>To turn on Call Forwarding:<br> Dial **21* + the phone number including area code, followed by #.<br> Example: **21*123-456-7890#<br> Press the call button.<br> A confirmation message is displayed on your device letting you know that
                        Call Forwarding has been turned on.<br>
                        <br> To turn off all Call Forwarding:<br> Dial ##21#<br> Press the call button.<br> A confirmation message is displayed on your device letting you know that Call Forwarding has been turned off.</p>
                </div>
            </li>
            <li data-category="3" style="display: none;">
                <h2>Trouble accessing voicemail<i>.</i></h2>
                <div class="answer">
                    <p>Voicemail passwords are set by default to the last 4 digits of the phone number assigned. <br>
                        <br> If the password is not working (change of number was done on the line, number port etc.) enter #793# on your keypad and press Call to automatically reset the voicemail password to the last 4 digits of the current active number
                        on that line.</p>
                </div>
            </li>
            <li data-category="3" style="display: none;">
                <h2>How to enable International Roaming?<i>.</i></h2>
                <div class="answer">
                    <p>International Roaming is disabled on all voice lines, but enabled on all data-only lines. <br>
                        <br> In order to enable International Roaming on your voice line, please send us an email to support@teltik.com with your phone number and request. We will respond shortly after with the International Roaming Terms. Once you respond
                        with your consent, we will enable International Roaming on your line.<br>
                        <br> International Roaming cannot be enabled within the first 30 days of service.<br>
                        <br> For more details about this feature, please see FAQ titled "All I need to know about international roaming."</p>
                </div>
            </li>
            <li data-category="3" style="display: none;">
                <h2>Can I keep my current device that I have now?<i>.</i></h2>
                <div class="answer">
                    <p>YES! As long as the device is T-Mobile branded, or GSM unlocked (bands compatible with T-Mobile), you can use it on our network. To unlock your device simply contact your current carrier or visit <a href="http://bit.ly/x_teltikcomms">DoctorSIM</a>                        which does a great job at unlocking just about ANY device at great prices along with solid support. Check them out by clicking <a href="http://bit.ly/x_teltikcomms">Here</a>.</p>
                </div>
            </li>
            <li data-category="3" style="display: none;">
                <h2>Should I call my current carrier to cancel service once I have placed an order?<i>.</i></h2>
                <div class="answer">
                    <p>NO! DO NOT call your current carrier to cancel until AFTER your number has been ported successfully. </p>
                </div>
            </li>
            <li data-category="3" style="display: none;">
                <h2>I ported my number and it's not working<i>.</i></h2>
                <div class="answer">
                    <p>Porting over a new number can take up to 24 hours to go though fully. Time of porting will depend on how long it takes for the other carrier to release the line. Lines coming from one of the big carriers are usually released immediately.
                        Port-ins from landlines can take up to 2 weeks although they usually go through much sooner. Turning off the phone with the old provider could help as well.<br>
                        <br> If the issues persists please get in touch with us by phone or email. support@teltik.com - 888­ 406 2838</p>
                </div>
            </li>
        </ul>
    </section>

    <aside class="support">
        <div class="info">
            <h3>Got Questions? <span>We’re listening!</span></h3>
            <p><span>Toll Free:</span> (888) ­406-2838</p>
            <p><span>Local:</span> (732) ­399-0021</p>
            <p>Teltik Communications<br> 731 Route 18 South <br> East Brunswick, NJ 08816</p>

        </div>

        <form action="#" method="post">
            <h6>Send Us a message</h6>
            <input name="contactForm" value="1" type="hidden">
            <input name="name" placeholder="Name" value="" type="text">
            <input name="email" placeholder="Email" value="" type="email">
            <input name="subject" placeholder="Subject" value="" type="text">
            <textarea name="message" placeholder="Message"></textarea>
            <input value="Send It" type="submit">
        </form>
    </aside>

</div>


<div class="map">
	<div class="close-map">x</div>
	<iframe src="https://maps.t-mobile.com/" frameborder="0"></iframe>
</div>

<div class="overlay">&nbsp;</div>

<div id="cart-drop-mobile">
    <a href="#" class="btn style1 btn-cart">
        <i class="fa fa-shopping-cart"></i>
        Your Cart (1)
    </a>
    <a href="#" class="btn style3 place-order-btn">Place Order</a>
    <div class="drop-con">
        
        <strong>Selected Solutions</strong>

        <ul class="cart-list">
            <li>
                <div class="img-wrap"></div>
                <div class="info">
                    <table>
                        <tr>
                            <td>Device: <a href="#">iPhoneX</a></td>
                            <td><strong>$340</strong></td>
                        </tr>
                        <tr>
                            <td>Plan: <strong>N/A</strong></td>
                            <td><strong>--</strong></td>
                        </tr>
                        <tr>
                            <td>Sim Card: <strong>N/A</strong></td>
                            <td><strong>--</strong></td>
                        </tr>
                        <tr>
                            <td>Add-Ons: <strong>N/A</strong></td>
                            <td><strong>--</strong></td>
                        </tr>
                    </table>
                </div>
                <div class="clearfix"></div>
                <div class="btn-set-action">
                    <div class="text-right">
                        <a href="#">
                            <i class="fa fa-pencil"></i>
                            Edit
                        </a>
                    </div>
                    <div class="text-left">
                        <a href="#">
                            <i class="fa fa-trash-alt"></i>
                            Remove
                        </a>
                    </div>
                </div>
            </li>
        </ul>

        <div class="summary">
            <table>
                <tr>
                    <td>Subtotal:</td>
                    <td>$69.95</td>
                </tr>
                <tr>
                    <td>Shipping:</td>
                    <td>$0.00</td>
                </tr>
                <tr>
                    <td>Coupons:</td>
                    <td>-$15.00</td>
                </tr>
                <tr>
                    <td>Tax/Fees:</td>
                    <td>$7.95</td>
                </tr>
            </table>
        </div>

        <div class="total">
            <table>
                <tr>
                    <td>Account Credits</td>
                    <td>-$27.00</td>
                </tr>
                <tr>
                    <td><strong>Total Due Today</strong></td>
                    <td><strong>$87.95</strong></td>
                </tr>
            </table>
        </div>

        <a href="#" class="btn">Place Order</a>

    </div>
</div>


@endsection
 
@push('js')

{!! Html::script('https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js') !!}
{!! Html::script('js/jquery.marquee.min.js') !!}
{!! Html::script('js/bootstrap.min.js') !!}
{!! Html::script('js/functions.min.js') !!}
{!! Html::script('js/main.js') !!}

@endpush
<!-- end FOOTER -->