<?php
	if(empty($msg[1])){
		$this->sendMessage($invokerid, Bot::$l->error_give_pin_channelpin);
	}else{
		$query = Bot::$db->query("SELECT COUNT(id) AS `count`, `cid`, `cldbid`, `connection_client_ip` FROM `channel` WHERE `pin` = '{$msg[1]}'");
		while($row = $query->fetch()){
			if($row['count'] == 0){
				$this->sendMessage($invokerid, Bot::$l->error_lack_of_channel_channelpin);
			}else{
				$channelInfo = Bot::$tsAdmin->getElement('data', Bot::$tsAdmin->channelInfo($row['cid']));
				$this->sendMessage($invokerid, Bot::$l->sprintf(Bot::$l->success_channel_info_channelpin, $channelInfo['channel_name'], $row['cid'], $row['cldbid'], $row['connection_client_ip']));
			}
		}
	}
?>