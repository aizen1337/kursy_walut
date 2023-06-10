<?php
class Fetch {
    public static function request($url, $options = array()) {
      $defaultOptions = array(
        'method' => 'GET',
        'headers' => array(),
        'body' => null,
      );
      $mergedOptions = array_merge($defaultOptions, $options);
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $mergedOptions['method']);
      $headers = array();
      foreach ($mergedOptions['headers'] as $key => $value) {
        $headers[] = $key . ': ' . $value;
      }
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      if (!empty($mergedOptions['body'])) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, $mergedOptions['body']);
      }
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($ch);
      if (curl_errno($ch)) {
        echo 'Error fetching data: ' . curl_error($ch);
      }
      curl_close($ch);
      return json_decode($response,true);
    }
  }