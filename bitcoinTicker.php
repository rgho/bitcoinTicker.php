<?php

////////////////////////////////////////////
// DATA SOURCES: TICKERS AND APIS.

function coindeskBPI(){
	$data = json_decode(getResource('http://api.coindesk.com/v1/bpi/currentprice.json'),'TRUE');
	return $data['bpi']['USD']['rate'];
}

function btcChina(){
	$data = json_decode(getResource('https://data.btcchina.com/data/ticker'),'TRUE');
	return $data['ticker']['last'];
}

function OKCoin(){
	$data = json_decode(getResource('https://www.okcoin.com/api/ticker.do'),'TRUE');
	return $data['ticker']['last'];
}

function bitfinex(){
	$data = json_decode(getResource('https://api.bitfinex.com/v1/ticker/btcusd'),'TRUE');
	return $data['last_price'];
}

function coinbase(){
#appears to update once per minute.
	$data = json_decode(getResource('https://coinbase.com/api/v1/currencies/exchange_rates'),'TRUE');
	return $data['btc_to_usd'];
}

function mtGox(){
	$data = json_decode(getResource('http://data.mtgox.com/api/2/BTCUSD/money/ticker_fast'),'TRUE');
	return $data['data']['last']['value'];
}

function btce(){
	$data = json_decode(getResource('https://btc-e.com/api/2/btc_usd/ticker'),'TRUE');
	return $data['ticker']['last'];
}

function bitStamp(){
	$data = json_decode(getResource('https://www.bitstamp.net/api/ticker/'),'TRUE');
	return $data['last'];
}

function campBX(){
#CampBx Gives a 403 Forbidden error if not supplying a user agent string,
	$data = json_decode(getResource('http://campbx.com/api/xticker.php'),'TRUE');
	return $data['Last Trade'];
//return "error";
}

function kraken(){
	$data = json_decode(getResource('https://api.kraken.com/0/public/Ticker?pair=XBTUSD'),'TRUE');
	return $data['result']['XXBTZUSD']['c'][0];
}

function crypto_trade(){
	$data = json_decode(getResource('https://crypto-trade.com/api/1/ticker/btc_usd'),'TRUE');
	return $data['data']['last'];
}


function getResource($url){
	$ch = curl_init();
	// SET CURL OPTIONS
	$timeout = 5;
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	// SIMPLE HACK FOR HTTPS SUPPORT, IDEALLY, WOULD POINT CURL TO A *PEM FILE WITH CERTS.
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
}

?>
