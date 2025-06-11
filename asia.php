<?php
$Squer = [
"one" => "مرحبا بك في 
• بوت الشحن التلقائي ",
"two" => "شحن اسيا || AsiaCall 💠",
"three" => "ارسل رقم اسيا ❇️",
"four" => "ارسل كود الرساله النصيه الذي تم ارساله الى رقمك الان 📮",
"five" => "ارسل كمية الشحن على سبيل المثال 5000 وهكذا 📤
• كل 1000 دينار ب 5000 نقاط 🛒",
"six" => "الكود خطاء ❌️",
"seven" => "ارسل رمز التحقق لكي تتم العمليه بنجاح ⚠️",
"eight" => "تمت عملية الشحن بنجاح ✅
• وتمت اضافه النقاط تلقائي 👥",
"nine" => "لم تتم العمليه يرجى محاوله في وقت اخر 🗑",
"ten" => "عذرآ لايوجد لديك رصيد كافي ❌",
"none"=> "رجوع ♻️",];
$Token = "{TOKEN}"; 
define('TOKEN', $Token);
define('USR_BOT', '{USR_BOT}');
$botData = json_decode(file_get_contents('../../asi4n_' . USR_BOT . '.json'), true);
$admin_id = $botData['admin_id'];
echo file_get_contents("https://api.telegram.org/bot" . TOKEN . "/setwebhook?url=" . $_SERVER['SERVER_NAME'] . $_SERVER['SCRIPT_NAME']);
function spark($method, $datas = []) {
    $fop = http_build_query($datas);
    $url = "https://api.telegram.org/bot" . TOKEN . "/" . $method . "?$fop";
    $Spark = file_get_contents($url);
    return json_decode($Spark);
}
//تم برمجه وكتابه الملف من المبرمج ناميرو Namero مش هسامح حد ليوم الدين ان غيره الحقوق ونشرته بدون مصدر 
# معرف المبرمج @s_p_p1
#- قناه المبرمج @bots_5
$update = json_decode(file_get_contents('php://input'));
$message = $update->message ?? null;
$text = $message->text ?? null;
$name = $message->from->first_name ?? '';
$user = $message->from->username ?? '';
$id = $message->from->id;
$message_id = $message->message_id ?? null;
if (isset($update->callback_query)) {
    $update = $update->callback_query;
    $id = $update->from->id;
    $user = $update->from->username;
    $name = $update->from->first_name;
    $message_id = $update->message->message_id;
    $data = $update->data;}
$bot_id_path = "bot_id.json"; 
if (!file_exists($bot_id_path)) {
    file_put_contents($bot_id_path, json_encode(["bot_id" => null])); 
}
$bot_data = json_decode(file_get_contents($bot_id_path), true);
    $bot_id_message = ($bot_id) ? "- البوت المربوط : $bot_id 🦾" : "❌ لم ربط البوت 📤";
$bot_id = $bot_data['bot_id'];    
if (!is_dir("Class.Asia.Users")) {
    mkdir("Class.Asia.Users", 0755, true);}
$pointsPath = "../../YY30Bot/". $bot_id;
if (!is_dir($pointsPath)) {
    mkdir($pointsPath, 0755, true);}
$asia = json_decode(file_get_contents("Class.Asia.Users/$id.json"), true);
if (!file_exists("asia_phone.json")) {
    file_put_contents("asia_phone.json", json_encode(["phone" => null])); 
}
if (!file_exists("points_rate.json")) {
    file_put_contents("points_rate.json", json_encode(["points_per_dinar" => 5]));
}
//تم برمجه وكتابه الملف من المبرمج ناميرو Namero مش هسامح حد ليوم الدين ان غيره الحقوق ونشرته بدون مصدر 
# معرف المبرمج @s_p_p1
#- قناه المبرمج @bots_5
$points_rate_data = json_decode(file_get_contents("points_rate.json"), true);
$points_per_dinar = $points_rate_data['points_per_dinar'];

$asia_phone_data = json_decode(file_get_contents("asia_phone.json"), true);
$phone_asia = $asia_phone_data['phone']; 
if ($text == "/start" && $id == $admin_id) {
    unset($asia[$id]["Mode"]);
    Save($id, $asia); 

    $bot_id_message = ($bot_id) ? "- البوت المربوط : @$bot_id 🦾" : "❌ لم ربط البوت 📤";
    $phone_message = ($phone_asia && $phone_asia !== "077") ? "- الرقم الحالي : $phone_asia ⚙️" : "❌ لم يتم تعيين الرقم 📤";    

    $admin_message = "- لوحة تحكم الآدمن 🤖
    
\n$phone_message\n$bot_id_message\n

- يمكنك ربط بوت الرشق عبر الازرار 🧐";
    SendMessage($id, $admin_message, "تعيين رقم آسيا 🅿️", "set_asia_phone", "تعيين معرف البوت 🦾", "set_bot_id");
}
if ($text == "/start" && $id == $admin_id) {    
    $admin_message = "ربط البوت 💎";
  SendMessage($id, $admin_message,"ربط معرف البوت 🦾", "set_bot_id");
}
if ($data == "set_bot_id" && $id == $admin_id) {
    EditMessageText($id, $message_id, "🔷 أرسل معرف البوت الجديد الراد ربطه ببوت الرشق بدون @ 🛒", "رجوع", "Back");
    $asia[$id]["Mode"] = "SetBotId";
    Save($id, $asia);
}
if (isset($asia[$id]["Mode"]) && $asia[$id]["Mode"] == "SetBotId" && isset($text) && !empty($text)) {
    if (preg_match("/^[a-zA-Z0-9_]+$/", $text)) {
        $new_bot_id = $text;
        file_put_contents($bot_id_path, json_encode(["bot_id" => $new_bot_id]));
        SendMessage($id, "✅ تم ربط البوت الجديد : @$new_bot_id", "رجوع", "Back");
        $asia[$id]["Mode"] = null;
        Save($id, $asia);
    } else {
        SendMessage($id, "❌ المعرف غير صحيح. يجب أن يحتوي على حروف وأرقام فقط.", "رجوع", "Back");
    }
} 
if ($text == "/start") {
    $rshq = json_decode(file_get_contents("$pointsPath/rshq.json"), true);
    $current_points = $rshq['coin'][$id] ?? 0;
    $welcome_message = "مرحبا بك، $name 
• نقاطك $current_points"; 
    SendMessage($id, $welcome_message, "شحن اسيا || AsiaCall 🛍", "Asia");}
if ($data == "Back") {
    $rshq = json_decode(file_get_contents("$pointsPath/rshq.json"), true);
    $current_points = $rshq['coin'][$id] ?? 0;
    $welcome_message = "مرحبا بك، $name 
• نقاطك $current_points"; 
    EditMessageText($id, $message_id, $welcome_message, "شحن اسيا || AsiaCall 🛍", "Asia");
    
    $asia[$id]["Mode"] = null;
    Save($id, $asia);
}
if ($data == "set_asia_phone" && $id == $admin_id) {
    EditMessageText($id, $message_id, "🔷 أرسل رقم هاتف آسيا الجديد (يجب أن يبدأ بـ 077):", "رجوع", "Back");
    $asia[$id]["Mode"] = "SetPhone";
    Save($id, $asia);
}
if (isset($asia[$id]["Mode"]) && $asia[$id]["Mode"] == "SetPhone" && isset($text) && !empty($text)) {
    if (is_numeric($text) && strlen($text) == 11 && substr($text, 0, 3) == "077") {
        $new_phone = $text;
        file_put_contents("asia_phone.json", json_encode(["phone" => $new_phone]));
        SendMessage($id, "✅ تم تعيين رقم هاتف آسيا الجديد: $new_phone", "رجوع", "Back");
        $asia[$id]["Mode"] = null;
        Save($id, $asia);
    } else {
        SendMessage($id, "❌ الرقم غير صحيح. يجب أن يكون مكونًا من 11 رقمًا ويبدأ بـ 077.", "رجوع", "Back");
    }
}    
if ($data == "Asia") {
    EditMessageText($id, $message_id, $Squer["three"], $Squer["none"], "Back");
    $asia[$id]["Mode"] = "Lo";
    Save($id, $asia);}
if ($text != "/start" && is_numeric($text) && $asia[$id]["Mode"] == "Lo") {
    $bx = LoginDB($text);
    SendMessage($id, $Squer["four"], $Squer["none"], "Back");
    $asia[$id]["Mode"] = "Code";
    $asia[$id]["Pid"] = $bx;
    Save($id, $asia);
    exit(0);}
if (is_numeric($text) && isset($text) && !empty($text) && $asia[$id]["Mode"] == "Code") {
    $op = pass($text, $asia[$id]["Pid"]);
    $op = json_decode($op, true);
    if ($op['success'] == true) {
        $asia[$id]["Token"] = $op['access_token'];
        $asia[$id]["Mode"] = "Tran";
        Save($id, $asia);
        SendMessage($id, $Squer["five"], $Squer["none"], "Back");
        exit(0);
    } else {
        SendMessage($id, $Squer["six"], $Squer["none"], "Back");}}
if (is_numeric($text) && isset($text) && !empty($text) && $asia[$id]["Mode"] == "Tran") {
    $tti = Tran($asia[$id]["Token"], $text, $phone_asia);
    $tti = json_decode($tti, true);
    if ($tti['success'] == true) {
        $asia[$id]["Pid"] = $tti['PID'];
        $asia[$id]["amount"] = $text;
        $asia[$id]["Mode"] = "Check";
        Save($id, $asia);
        SendMessage($id, $Squer["seven"], $Squer["none"], "Back");
        exit(0);
    } else {
        SendMessage($id, $Squer["ten"], $Squer["none"], "Back");    }}
if (is_numeric($text) && isset($text) && !empty($text) && $asia[$id]["Mode"] == "Check") {
    $Check = Check($asia[$id]["Token"], $asia[$id]["Pid"], $text);
    $Checkx = json_decode($Check, true);
    if ($Checkx['success'] == true) {
        $amount = $asia[$id]["amount"];
        $points_to_add = $amount * 5; 
        $fr_id = $id;
        $rshq = json_decode(file_get_contents("$pointsPath/rshq.json"), true);
        $current_points = $rshq['coin'][$fr_id] ?? 0;
        $rshq['coin'][$fr_id] = $current_points + $points_to_add;
        file_put_contents("$pointsPath/rshq.json", json_encode($rshq));
        SendMessage($id, $Squer["eight"], $Squer["none"], "Back");
    } else {
        SendMessage($id, $Squer["nine"], $Squer["none"], "Back");    }}
function SendMessage($id, $text, $text1, $call) {
    spark("SendMessage", [
        "chat_id" => $id,
        "text" => $text,
        "reply_markup" => json_encode([
            'inline_keyboard' => [
                [["text" => "$text1", "callback_data" => "$call"]],
            ]   ])    ]);}
function EditMessageText($id, $message_id, $text, $text1, $call) {
    spark("EditMessageText", [
        "chat_id" => $id,
        "message_id" => $message_id,
        "text" => $text,
        "reply_markup" => json_encode([
            "inline_keyboard" => [
                [["text" => "$text1", "callback_data" => "$call"]],
            ] ])]);
            }
 //تم برمجه وكتابه الملف من المبرمج ناميرو Namero مش هسامح حد ليوم الدين ان غيره الحقوق ونشرته بدون مصدر 
# معرف المبرمج @s_p_p1
#- قناه المبرمج @bots_5           
function Save($id, $var) {
    $asia = json_decode(file_get_contents("Class.Asia.Users/$id.json"), true);
    $asia = json_encode($var, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    file_put_contents("Class.Asia.Users/$id.json", $asia);}
function LoginDB($num){
$res = substr(str_shuffle("0987654321"),1,4);
 $ch = curl_init();
       curl_setopt_array($ch, [
            CURLOPT_URL => "https://odpapp.asiacell.com/api/v1/login?lang=en",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => [
                 "X-ODP-API-KEY: 1ccbc4c913bc4ce785a0a2de444aa0d6",
                    "DeviceID: 86b73a89-feec-".$res."-9ab5-35920aec739c",
                      "X-OS-Version: 12",
                        "X-Device-Type: [Android][INFINIX][Infinix X665E 12][S]",
                          "X-ODP-APP-VERSION: 4.0.4",
                             "X-FROM-APP: odp",
                                 "X-ODP-CHANNEL: mobile",
                                      "X-SCREEN-TYPE: MOBILE",
                                         "Content-Type: application/json; charset=UTF-8",
               ],
CURLOPT_POSTFIELDS =>'{"captchaCode":"","username":"'.$num.'"}',
  CURLOPT_ENCODING => "gzip",
 ]);
$result = json_decode(curl_exec($ch),true);
  curl_close($ch);
    $pid = $result["nextUrl"];
        $tx = explode("=",$pid)[2];
            return $tx;}
function pass($es,$io){
$ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => "https://odpapp.asiacell.com/api/v1/smsvalidation?lang=en", 
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_HTTPHEADER => [
            "X-ODP-API-KEY: 1ccbc4c913bc4ce785a0a2de444aa0d6",
              "DeviceID: 86b73a89-feec-4202-9ab5-35920aec739c",
                 "X-OS-Version: 12",
                    "X-Device-Type: [Android][INFINIX][Infinix X665E 12][S]",
                         "X-ODP-APP-VERSION: 4.0.4",
                              "X-FROM-APP: odp",
                                 "X-ODP-CHANNEL: mobile",
                                      "X-SCREEN-TYPE: MOBILE",
                                          "Content-Type: application/json; charset=UTF-8",
           ], 
CURLOPT_POSTFIELDS => '{"PID":"'.$io.'","passcode":"'.$es.'","token":"eYIPfXJTQ6aULUnLNWF8cV:APA91bGFr_3ySwVZvGBlAstaHjXKj8IKFiR7mEb4MjxnrDHi-x-rHMQgggUd5xOqOKiD_gGb7Z69kDtETLnNk6NjILHJhQAyMsx0FaDfmUGYciqC7jhXdwrwm0b82T_ymDz9JwgvmSc3"}',
  CURLOPT_ENCODING => "gzip",
  ]);
$result = curl_exec($ch);
   curl_close($ch);
      return $result;}
function Tran($isp,$amount,$phone){
$ch = curl_init();
     curl_setopt_array($ch, [
         CURLOPT_URL => "https://odpapp.asiacell.com/api/v1/credit-transfer/start?lang=en",
         CURLOPT_RETURNTRANSFER => true,
         CURLOPT_CUSTOMREQUEST => "POST",
         CURLOPT_HTTPHEADER => [
              "Authorization: Bearer $isp",
                 "X-ODP-API-KEY: 1ccbc4c913bc4ce785a0a2de444aa0d6",
                     "DeviceID: 86b73a89-feec-4202-9ab5-35920aec739c",
                          "X-OS-Version: 12",
                              "X-Device-Type: [Android][INFINIX][Infinix X665E 12][S]",
                                   "X-ODP-APP-VERSION: 4.0.4",
                                        "X-FROM-APP: odp",
                                             "X-ODP-CHANNEL: mobile",
                                                   "X-SCREEN-TYPE: MOBILE",
                                                        "Content-Type: application/json; charset=UTF-8",
         ], 
CURLOPT_POSTFIELDS => '{"receiverMsisdn":"'.$phone.'","amount":"'.$amount.'"}',
  CURLOPT_ENCODING => "gzip",
 ]);
 //تم برمجه وكتابه الملف من المبرمج ناميرو Namero مش هسامح حد ليوم الدين ان غيره الحقوق ونشرته بدون مصدر 
# معرف المبرمج @s_p_p1
#- قناه المبرمج @bots_5
$result = curl_exec($ch);
  curl_close($ch);
     return $result;}
function Check($isp,$pid,$es){
$ch = curl_init();
   curl_setopt_array($ch, [
      CURLOPT_URL => "https://odpapp.asiacell.com/api/v1/credit-transfer/do-transfer?lang=en",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_HTTPHEADER => [
          "Authorization: Bearer $isp",
             "X-ODP-API-KEY: 1ccbc4c913bc4ce785a0a2de444aa0d6",
                 "DeviceID: 86b73a89-feec-4202-9ab5-35920aec739c",
                     "X-OS-Version: 12",
                          "X-Device-Type: [Android][INFINIX][Infinix X665E 12][S]",
                               "X-ODP-APP-VERSION: 4.0.4",
                                  "X-FROM-APP: odp",
                                      "X-ODP-CHANNEL: mobile",
                                         "X-SCREEN-TYPE: MOBILE",
                                             "Content-Type: application/json; charset=UTF-8",
    ], 
CURLOPT_POSTFIELDS => '{"PID":"'.$pid.'","passcode":"'.$es.'"}',
  CURLOPT_ENCODING => "gzip",
  ]);
$result = curl_exec($ch);
   curl_close($ch);
      return $result;
}
//تم برمجه وكتابه الملف من المبرمج ناميرو Namero مش هسامح حد ليوم الدين ان غيره الحقوق ونشرته بدون مصدر 
# معرف المبرمج @s_p_p1
#- قناه المبرمج @bots_5