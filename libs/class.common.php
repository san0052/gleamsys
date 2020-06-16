<?php

class sql_db
{
	/*
	public $db_connect_id;
	public $query_result;
	public $row = array();
	public $rowset = array();
	public $num_queries = 0;
	*/
	//
	// Constructor
	//
	function sql_db($sqlserver, $sqluser, $sqlpassword, $database, $persistency = true)
	{
		$this->persistency	=	$persistency;
		$this->user			=	$sqluser;
		$this->password		=	$sqlpassword;
		$this->server		=	$sqlserver;
		$this->dbname		=	$database;
	
		if($database != "")
		{
			$this->dbname = $database;
			$this->db_connect_id = @mysqli_connect($this->server, $this->user, $this->password, $this->dbname);
			if(mysqli_connect_errno())
			{
				return false;
			}
			else 
			{
				return $this->db_connect_id;
			}
		}
	}
			
	function swapDB($dbServer, $userName, $password, $dbName, $persistence=false)
	{
		$this->sql_close();
		$this->currentDB = array('DB_SERVER' => $this->server,
								 'DB_SERVER_USERNAME' => $this->user,
								 'DB_SERVER_PASSWORD' => $this->password,
								 'DB_DATABASE' => $this->dbname,
								 'DB_PERSISTENCE' => $this->persistency);
	
		return $this->sql_db($dbServer, $userName, $password, $dbName, $persistence);
	}
		
	function swapbackDB()
	{
		$this->sql_close();
		$cfgSwap = $this->currentDB;
		return $this->sql_db($cfgSwap['DB_SERVER'], $cfgSwap['DB_SERVER_USERNAME'], $cfgSwap['DB_SERVER_PASSWORD'], $cfgSwap['DB_DATABASE'], $cfgSwap['DB_PERSISTENCE']);
	}
	
	/**
	*
	*	sql_close methods
	*	Close an Active Sql Query
	*
	**/
	
	function sql_close()
	{
		if($this->db_connect_id)
		{
			if($this->query_result)
			{
				@mysqli_free_result ($this->query_result);
			}
			$result = @mysqli_close($this->db_connect_id);
			return $result;
		}
		else
		{
			return false;
		}
	}
	
	/**
	*
	*	sql_query methods
	*	Run an Active Sql Query
	*
	**/
	
	function sql_query($query = "")
	{
		// Remove any pre-existing queries
		unset($this->query_result);
		if($query != "")
		{
			$this->num_queries++;	
			$this->query_result = @mysqli_query($this->db_connect_id, $query);
		}
		if($this->query_result)
		{
			unset($this->row[$this->query_result]);
			unset($this->rowset[$this->query_result]);
			return $this->query_result;
		}
		else
		{
			return die(mysqli_error($this->db_connect_id));
		}
	}
	
	/**
	*
	*	sql_numrows methods
	*	Close an Active Sql Query
	*
	**/
	
	function sql_numrows($query_id = 0)
	{
		if(!$query_id)
		{
			$query_id = $this->query_result;
		}
		if($query_id)
		{
			$result = @mysqli_num_rows($query_id);
			return $result;
		}
		else
		{
			return false;
		}
	}
		
	function sql_fetchrow($query_id = 0)
	{
		if(!$query_id)
		{
			$query_id = $this->query_result;
		}
		if($query_id)
		{
			$this->row = @mysqli_fetch_assoc($query_id);
			/*
			while($data = mysqli_fetch_assoc($query_id))
			{
				$this->row[]	=	$data;
				print_r($this->row);
			}
			*/
			//print_r($this->row);
			return $this->row;
		}
		else
		{
			return false;
		}
	}
	
	function sql_fetchrowset($query_id = 0)
	{
		if(!$query_id)
		{
			$query_id = $this->query_result;
		}
		if($query_id)
		{
			unset($this->rowset[$query_id]);
			unset($this->row[$query_id]);
			while($this->rowset[$query_id] = @mysqli_fetch_array($query_id))
			{
				$result[] = $this->rowset[$query_id];
			}
			return $result;
		}
		else
		{
			return false;
		}
	}
	
	function sql_fetchfield($field, $rownum = -1, $query_id = 0)
	{	
		if(!$query_id)
		{
			$query_id = $this->query_result;
		}
		if($query_id)
		{
			if($rownum > -1)
			{
				$result = @mysqli_result($query_id, $rownum, $field);
			}
			else
			{
				if(empty($this->row[$query_id]) && empty($this->rowset[$query_id]))
				{
					if($this->sql_fetchrow())
					{
						$result = $this->row[$query_id][$field];
					}
				}
				else
				{
					if($this->rowset[$query_id])
					{
						$result = $this->rowset[$query_id][$field];
					}
					else if($this->row[$query_id])
					{
						$result = $this->row[$query_id][$field];
					}
				}
			}
			return $result;
		}
		else
		{
			return false;
		}
	}
	
	function sql_nextid()
	{
		if($this->db_connect_id)
		{
			$result = @mysqli_insert_id($this->db_connect_id);
			return $result;
		}
		else
		{
			return false;
		}
	}
	
	/**
		ASC, DESC
	*/
	function sql_sort()
	{
		$sort = (isset($_REQUEST['sort']) AND isset($_REQUEST['type']))?"ORDER BY `".$_REQUEST['sort']."` ".$_REQUEST['type']." ":"";
		return $sort;
	}
	
	function sql_error($query_id = 0)
	{
		$result["message"] = @mysql_error($this->db_connect_id);
		$result["code"] = @mysql_errno($this->db_connect_id);
	
		return $result;
	}
} // class sql_db



class commonClass extends sql_db {
	/**
	* Name:		commonClass() [class constructor]
	* Params:		null
	* Returns:		null
	* Description:		null (Style :// re_head ://re_body)
	*Create an instance of the class 'MainClass' and make a database connection.
	*
	*/

	function commonClass(){
		global $cfg;
		$GLOBALS['nb'] = $cfg;

		$this->sql_db($cfg['DB_SERVER'], $cfg['DB_SERVER_USERNAME'], $cfg['DB_SERVER_PASSWORD'], $cfg['DB_DATABASE'], false);
		if(!$this->db_connect_id)
		{
			die("Could not connect to the database");
		}
		$this->ip = $this->ipCheck();
	}

	function swapDB($dbServer, $userName, $password, $dbName, $persistence=false){
		$this->sql_close();
		$this->currentDB = array('DB_SERVER' => $this->server,
								 'DB_SERVER_USERNAME' => $this->user,
								 'DB_SERVER_PASSWORD' => $this->password,
								 'DB_DATABASE' => $this->dbname,
								 'DB_PERSISTENCE' => $this->persistency);

		return $this->sql_db($dbServer, $userName, $password, $dbName, $persistence);
	}

	function swapbackDB(){

		$this->sql_close();
		$cfgSwap = $this->currentDB;
		return $this->sql_db($cfgSwap['DB_SERVER'], $cfgSwap['DB_SERVER_USERNAME'], $cfgSwap['DB_SERVER_PASSWORD'], $cfgSwap['DB_DATABASE'], $cfgSwap['DB_PERSISTENCE']);
		
	}

	/**
	* Name:			Redirect()
	* Params:		varchar request url , optional (varchar message , int time)
	* Returns:		void
	* Description:	Work's just like PHP header function. But difference is that it's print an
	*				table with meta tag due to an error occure redirect url.
	*/

	/*function redirect($url,$message='',$time='1')
	{
		if (!headers_sent()) {
			//header('Location:'.$newURl);
			header('Location: https://www.omlp2p.com/'.$url);
		} else {
			
		}
	}
*/
	function redirect($url,$message='',$time='1')
	{
		$new_dir = (dirname($_SERVER['PHP_SELF'])=="/")?"":dirname($_SERVER['PHP_SELF']);
		$newURl = trim(str_replace("\/","/","http://" . $_SERVER['HTTP_HOST'] .$new_dir . "/" . $url));
		if (!headers_sent()) {
			//header('Location:'.$newURl);
			header('Location:'.$url);
		} else {
			$re_err="";
			$message = ($message=='')?'Alert':'';
			$re_err.="<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\">\n";
			$re_err.="<html>\n";
			$re_err.="<head>\n";
			$re_err.="<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">\n";
			$re_err.="<meta http-equiv='Refresh' content='".$time."; url=".$newURl."'>\n";
			$re_err.="<title>Redirect</title>\n";
			$re_err.="<meta http-equiv='Refresh' content='".$time.";url=".$newURl."'>\n";
			$re_err.="</body>";
			$re_err.="</html>";
			die($re_err);
		}
	}
	
	////////////////////////////////////////////////////////////////////////////////////////////////////
	/**
	* Name:   		generate_pagination()
	* Params:		null
	* Returns:		void
	* Description:	Pagination routine, generates, page number sequence.
	*/
	
	////////////////////////////////////////////////////////////////////////////////////////////////////

	/**
	* Name:   		generate_pagination()
	* Params:		null
	* Returns:		void
	* Description:	Pagination routine, generates, page number sequence.
	* $pagina = paginate($numRows, $maxRows, $pageNum=0, $pageVar="pageno", $class="txtLink");
	* print $pagina;
	*/
	function paginate($numRows, $maxRows, $pageNum=0, $pageVar="pageno", $class="topTags")
	{
	$navigation = "";

	// get total pages
	$totalPages = ceil($numRows/$maxRows);

	// develop query string minus page vars
	$queryString = "";
		if (!empty($_SERVER['QUERY_STRING'])) {
			$params = explode("&", $_SERVER['QUERY_STRING']);
			$newParams = array();
				foreach ($params as $param) {
					if (stristr($param, $pageVar) == false) {
						array_push($newParams, $param);
					}
				}
			if (count($newParams) != 0) {
				$queryString = "&" . htmlentities(implode("&", $newParams));
			}
		}

	// get current page
	$currentPage = $_SERVER['PHP_SELF'];

	// build page navigation
	if($totalPages> 1){
	$navigation = "<SPAN class='total_page'>".$totalPages." Pages&nbsp;&nbsp;</span>";

	$upper_limit = $pageNum + 3;
	$lower_limit = $pageNum - 3;

		if ($pageNum > 0) { // Show if not first page

			if(($pageNum - 2)>0){
			$first = sprintf("%s?".$pageVar."=%d%s", $currentPage, 0, $queryString);
			$navigation .= "<SPAN class='".$class."'><a href='".$first."'>First</a></span>";}

			$prev = sprintf("%s?".$pageVar."=%d%s", $currentPage, max(0, $pageNum - 1), $queryString);
			$navigation .= "<SPAN class='".$class."'><a href='".$prev."'>Previous</a></span>";
		} // Show if not first page

		// get in between pages
		for($i = 0; $i < $totalPages; $i++){

			$pageNo = $i+1;

			if($i==$pageNum){
				$navigation .= "<span class='select'>".$pageNo."</span>";
			} elseif($i!==$pageNum && $i<$upper_limit && $i>$lower_limit){
				$noLink = sprintf("%s?".$pageVar."=%d%s", $currentPage, $i, $queryString);
				$navigation .= "<a href='".$noLink."'><span class='".$class."'>".$pageNo."</span></a>";
			} elseif(($i - $lower_limit)==0){
				//$navigation .=  "&hellip;";
				$navigation .=  "";
			}
		}

		if (($pageNum+1) < $totalPages) { // Show if not last page
			$next = sprintf("%s?".$pageVar."=%d%s", $currentPage, min($totalPages, $pageNum + 1), $queryString);
			$navigation .= "<a href='".$next."'><SPAN class='".$class."'>Next</span></a>";
			if(($pageNum + 3)<$totalPages){
			$last = sprintf("%s?".$pageVar."=%d%s", $currentPage, $totalPages-1, $queryString);
			$navigation .= "<a href='".$last."'><SPAN class='".$class."'>Last</span></a>";}
		} // Show if not last page

		} // end if total pages is greater than one

		return $navigation;

	}



////////////////////////////////////////////////////////////////////////////////////////////////////

	/**
	* Name:   		microtime_float()
	* Params:		null
	* Returns:		void
	* Description:	calculate microtime.
	*/

	function microtime_float(){
		list($usec, $sec) = explode(" ", microtime());
		return ((float)$usec + (float)$sec);
	}

	/**
	* Name:    		del_cache()
	* Params:		null
	* Returns:		void
	* Description:	"File could not be cached..." error and the browser just hung waiting *				for the transfer to begin.
	*				After tinkering, reading these pages, trying the inline/image trick, *				trying all kinds of things I went
	*				on a hard search on Google. Nothing I treid seemed to work.
	*/

	function del_cache(){
		// Date in the past
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		// always modified
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		// HTTP/1.1
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Cache-Control: post-check=0, pre-check=0", false);
		// HTTP/1.0
		header("Pragma: no-cache");
	}

	/**
	* Name:        	login()
	* Params:		varchar User Name, varchar Password , varchar Action
	*				varchar page , varchar page1
	* Returns:		void
	* Description:	$gopage->go page;
	*			$pass=$this->decoded($pass);
	*			session_register("log_in"); 		// shows whether login or not...& return true/false...
	*			session_register("login_user");	// shows login user name...
	*			session_register("login_uid");	// shows login user id...
	*			session_register("usid");		// shows/generate current session id...
	*			session_register("lt");		// contain login date & time...
	*/

	function login($uname,$pass,$trackIp=false)
	{
		//*================== Log In or Log out status ==================*//
		$user_check_quary = "SELECT * FROM ".$GLOBALS['nb']['DB_WEBMASTER']." WHERE user_name='".$uname."' AND user_pass='".$pass."';";
		$user_check_result = $this->sql_query($user_check_quary);
		if ($this->sql_numrows($user_check_result)!=0){
			$field=$this->sql_fetchrow($user_check_result);
			//session_register("admin_log_in");					// Boolen value true or false
			//session_register("admin_login_uid");				// Login member id
			//session_register("admin_typeId");				// Login member id
			session_unset("admin_user_name");				// Login user name
			//session_register("LT");
			//session_register("rid");

			$_SESSION['admin_log_in']			= true;						//  Login success.
			$_SESSION['admin_login_uid']		= $field["a_id"];
			$_SESSION['admin_city']				= $field["city"];			//	Login city
			$_SESSION['admin_user_name']		= $field["user_name"];		//	Login member NAME
			$_SESSION['admin_typeId']			= $field["typeId"];			//	Login member ID
			$_SESSION['LT']						= date("Y-m-d H:m:s");		//  Login time

			return true;
		}
		else
		{
			$_SESSION['log_in']=false;
			return false;
		}
		/*=============== End of Login/out Process ====================*/
	}
	
	function callCenterlogin($uname,$pass,$trackIp=false)
	{
		//*================== Call Center User Log In or Log out status ==================*//
		$user_check_quary = "SELECT * FROM ".$GLOBALS['nb']['DB_CALLCENTER_EMPLOYEE']." WHERE `email` = '".$uname."' AND `password` = '".$pass."' AND `status` = 'A';";
		$user_check_result = $this->sql_query($user_check_quary);
		if ($this->sql_numrows($user_check_result)!=0){
			$field=$this->sql_fetchrow($user_check_result);
			session_unset("cemp_user_name");							// Login user name
			
			$_SESSION['cemp_log_in']		= true;						//  Login success.
			$_SESSION['cemp_login_uid']		= $field["id"];
			//$_SESSION['cemp_city']			= $field["city"];		//	Login city
			$_SESSION['cemp_user_name']		= $field["name"];			//	Login member NAME
			$_SESSION['cemp_typeId']		= '1';						//	Login member ID
			$_SESSION['cemp_LT']			= date("Y-m-d H:m:s");		//  Login time
			
			return true;
		}
		else
		{
			$_SESSION['log_in_cemp']=false;
			return false;
		}
		/*=============== End of Login/out Process ====================*/
	}
	
	function agentlogin($uname,$pass,$trackIp=false)
	{
		//*================== Agent Log In or Log out status ==================*//
		$user_check_quary = "SELECT * FROM ".$GLOBALS['nb']['DB_EMPLOYEE']." WHERE `email` = '".$uname."' AND `password` = '".$pass."' AND `status` = 'A';";
		$user_check_result = $this->sql_query($user_check_quary);
		if ($this->sql_numrows($user_check_result)!=0)
		{
			$field=$this->sql_fetchrow($user_check_result);
			session_unset("agent_user_name");						// Login user name
			
			$_SESSION['agent_log_in']		= true;					//  Login success.
			$_SESSION['agent_login_uid']	= $field["id"];
			//$_SESSION['agent_city']		= $field["city"];		//	Login city
			$_SESSION['agent_user_name']	= $field["name"];		//	Login member NAME
			$_SESSION['agent_typeId']		= '1';					//	Login member ID
			$_SESSION['agent_LT']			= date("Y-m-d H:m:s");	//  Login time
			
			return true;
		}
		else
		{
			$_SESSION['log_in_agent']=false;
			return false;
		}
		/*=============== End of Login/out Process ====================*/
	}

	/**
	* Name:			logout()
	* Params:		varchar pagename
	* Returns:		void
	* Description:	null
	*/
	
	function agreementVerifyAgentlogin($uname,$pass,$trackIp=false)
	{
		//*================== Agreement Verify Agent Log In or Log out status ==================*//
		$user_check_quary = "SELECT * FROM ".$GLOBALS['nb']['DB_EMPLOYEE_FOR_SIGNAGREEMENT']." WHERE `email` = '".$uname."' AND `password` = '".$pass."' AND `status` = 'A';";
		$user_check_result = $this->sql_query($user_check_quary);
		if ($this->sql_numrows($user_check_result)!=0){
			$field=$this->sql_fetchrow($user_check_result);
			session_unset("agreementVerifyemp_user_name");							// Login user name
			
			$_SESSION['agreementVerifyemp_log_in']		= true;						//  Login success.
			$_SESSION['agreementVerifyemp_login_uid']	= $field["id"];
			//$_SESSION['agreementVerifyemp_city']		= $field["city"];			//	Login city
			$_SESSION['agreementVerifyemp_user_name']	= $field["name"];			//	Login member NAME
			$_SESSION['agreementVerifyemp_typeId']		= '1';						//	Login member ID
			$_SESSION['agreementVerifyemp_LT']			= date("Y-m-d H:m:s");		//  Login time
			
			return true;
		}
		else
		{
			$_SESSION['log_in_agreementVerifyemp']=false;
			return false;
		}
		/*=============== End of Login/out Process ====================*/
	}
	
	function logout($gopage){
		// Log out status ...
		session_unset("admin_log_in");			// Boolen value true or false
		session_unset("admin_login_uid");		// Login member id
		session_unset("admin_typeId");		// Login member type id
		session_unset("admin_user_name");		// Login member id
		session_unset("LT");		// Login member id
		session_unset("lastActivityTime");
		if(session_destroy())
			return 	$this->redirect($gopage);
		else{
			$_SESSION['log_in']=false;
			return 	$this->redirect($gopage);
		}
	}

	function callCenterlogout($gopage){
		// Log out status ...
		session_unset("cemp_log_in");			// Boolen value true or false
		session_unset("cemp_login_uid");		// Login member id
		session_unset("cemp_typeId");			// Login member type id
		session_unset("cemp_user_name");		// Login member id
		session_unset("cemp_LT");				// Login member id
		if(session_destroy())
			return 	$this->redirect($gopage);
		else{
			$_SESSION['log_in_cemp']=false;
			return 	$this->redirect($gopage);
		}
	}
	
	function agentlogout($gopage){
		// Log out status ...
		session_unset("agent_log_in");			// Boolen value true or false
		session_unset("agent_login_uid");		// Login member id
		session_unset("agent_typeId");			// Login member type id
		session_unset("agent_user_name");		// Login member id
		session_unset("agent_LT");				// Login member id
		if(session_destroy())
			return 	$this->redirect($gopage);
		else{
			$_SESSION['log_in_agent']=false;
			return 	$this->redirect($gopage);
		}
	}
	
	function agreementVerifyAgentlogout($gopage){
		// Log out status ...
		session_unset("agreementVerifyemp_log_in");			// Boolen value true or false
		session_unset("agreementVerifyemp_login_uid");		// Login member id
		session_unset("agreementVerifyemp_typeId");			// Login member type id
		session_unset("agreementVerifyemp_user_name");		// Login member id
		session_unset("agreementVerifyemp_LT");				// Login member id
		if(session_destroy())
			return 	$this->redirect($gopage);
		else{
			$_SESSION['log_in_agreementVerifyemp']=false;
			return 	$this->redirect($gopage);
		}
	}

	/**
	* Name:    		isLogin()
	* Params:		null
	* Returns:		0 for true & 1 for false
	* Description:	This function check whether user are login or not...
	*/
	
	function isLogin($site="") {
		if($site!="") {
			if(isset($_SESSION['login']))
			{
				if($_SESSION['login']==false)
					return false;
				else
					return true;
			}
		}else {
			if(isset($_SESSION['admin_log_in']))
			{
				if($_SESSION['admin_log_in']==false)
					return false;
				else
					return true;
			}
		}
	}

	/**
	* Name:			encoded()
	* Params:		varchar statement
	* Returns:		void
	* Description:	It's return an encode form of a statement
	*
	*/

	function encoded($str)
	{
		return str_replace(array('=','+','/'),'',base64_encode(base64_encode($str)));
	}

	/**
	* Name:			decoded()
	* Params:		varchar statement
	* Returns:		void
	* Description:	It's return decode form of an encoded statement.
	*
	*/

	function decoded($str)
	{
		return base64_decode(base64_decode($str));
	}

	/*
	This function will try to find out if user is coming behind proxy server. Why is this important?
	If you have high traffic web site, it might happen that you receive lot of traffic
	from the same proxy server (like AOL). In that case, the script would count them all as 1 user.
	This function tryes to get real IP address.
	Note that getenv() function doesn't work when PHP is running as ISAPI module
	*/

	function ipCheck() {
		if (getenv('HTTP_CLIENT_IP')) {
			$ip = getenv('HTTP_CLIENT_IP');
		}
		elseif (getenv('HTTP_X_FORWARDED_FOR')) {
			$ip = getenv('HTTP_X_FORWARDED_FOR');
		}
		elseif (getenv('HTTP_X_FORWARDED')) {
			$ip = getenv('HTTP_X_FORWARDED');
		}
		elseif (getenv('HTTP_FORWARDED_FOR')) {
			$ip = getenv('HTTP_FORWARDED_FOR');
		}
		elseif (getenv('HTTP_FORWARDED')) {
			$ip = getenv('HTTP_FORWARDED');
		}
		else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}
}
/***************************************************************************
*                              class.Thumbnail
*                            -------------------
*   begin                : Saturday, Feb 05, 2005
*   copyright            : GNU General Public License
*
*   $Id: class.common.php,v 1.16 2005/11/18 11:37:01 PM psotfx Exp $
*
***************************************************************************/

class Thumbnail
{
	function Thumbnail($resource_file, $max_width, $max_height, $destination_file="", $compression=80, $transform="")
	{
		$this->a = $resource_file;		// image to be thumbnailed
		$this->c = $transform;
		$this->d = $destination_file;	// thumbnail saved to
		$this->e = $compression;		// compression ration for jpeg thumbnails
		$this->m = $max_width;
		$this->n = $max_height;

		$this->compile();
		if($this->c !== "")
		{
			$this->manipulate();
			$this->create();
		}
	}
	function compile()
	{
		$this->h = getimagesize($this->a);
		if(is_array($this->h))
		{
			$this->i = $this->h[0];
			$this->j = $this->h[1];
			$this->k = $this->h[2];

			$this->o = ($this->i / $this->m);
			$this->p = ($this->j / $this->n);
			$this->q = ($this->o > $this->p) ? $this->m : round($this->i / $this->p); // width
			$this->r = ($this->o > $this->p) ? round($this->j / $this->o) : $this->n; // height
		}
		$this->s = ($this->k < 4) ? ($this->k < 3) ? ($this->k < 2) ? ($this->k < 1) ? Null : imagecreatefromgif($this->a) : imagecreatefromjpeg($this->a) : imagecreatefrompng($this->a) : Null;
		if($this->s !== Null)
		{
			$this->t = imagecreatetruecolor($this->q, $this->r); // created thumbnail reference
			$this->u = imagecopyresampled($this->t, $this->s, 0, 0, 0, 0, $this->q, $this->r, $this->i, $this->j);
		}
	}

	function hex2rgb($hex_value)
	{
		$this->decval = hexdec($hex_value);
		return $this->decval;
	}
	function bevel($edge_width=10, $light_colour="FFFFFF", $dark_colour="000000")
	{
		$this->edge = $edge_width;
		$this->dc = $dark_colour;
		$this->lc = $light_colour;
		$this->dr = $this->hex2rgb(substr($this->dc,0,2));
		$this->dg = $this->hex2rgb(substr($this->dc,2,2));
		$this->db = $this->hex2rgb(substr($this->dc,4,2));
		$this->lr = $this->hex2rgb(substr($this->lc,0,2));
		$this->lg = $this->hex2rgb(substr($this->lc,2,2));
		$this->lb = $this->hex2rgb(substr($this->lc,4,2));
		$this->dark = imagecreate($this->q,$this->r);
		$this->nadir = imagecolorallocate($this->dark,$this->dr,$this->dg,$this->db);
		$this->light = imagecreate($this->q,$this->r);
		$this->zenith = imagecolorallocate($this->light,$this->lr,$this->lg,$this->lb);
		for($this->pixel = 0; $this->pixel < $this->edge; $this->pixel++)
		{
			$this->opac =  100 - (($this->pixel+1) * (100 / $this->edge));
			ImageCopyMerge($this->t,$this->light,$this->pixel,$this->pixel,0,0,1,$this->r-(2*$this->pixel),$this->opac);
			ImageCopyMerge($this->t,$this->light,$this->pixel-1,$this->pixel-1,0,0,$this->q-(2*$this->pixel),1,$this->opac);
			ImageCopyMerge($this->t,$this->dark,$this->q-($this->pixel),$this->pixel,0,0,1,$this->r-(2*$this->pixel),max(0,$this->opac-10));
			ImageCopyMerge($this->t,$this->dark,$this->pixel,$this->r-($this->pixel+1),0,0,$this->q-(2*$this->pixel),1,max(0,$this->opac-10));
		}
		ImageDestroy($this->dark);
		ImageDestroy($this->light);
	}
	function greyscale($rv=38, $gv=36, $bv=26)
	{
		$this->rv = $rv;
		$this->gv = $gv;
		$this->bv = $bv;
		$this->rt = $this->rv+$this->bv+$this->gv;
		$this->rr = ($this->rv == 0) ? 0 : 1/($this->rt/$this->rv);
		$this->br = ($this->bv == 0) ? 0 : 1/($this->rt/$this->bv);
		$this->gr = ($this->gv == 0) ? 0 : 1/($this->rt/$this->gv);
		for( $this->dy = 0; $this->dy <= $this->r; $this->dy++ )
		{
			for( $this->dx = 0; $this->dx <= $this->q; $this->dx++ )
			{
				$this->pxrgb = imagecolorat($this->t, $this->dx, $this->dy);
				$this->rgb = ImageColorsforIndex( $this->t, $this->pxrgb );
				$this->newcol = ($this->rr*$this->rgb['red'])+($this->br*$this->rgb['blue'])+($this->gr*$this->rgb['green']);
				$this->setcol = ImageColorAllocate( $this->t, $this->newcol, $this->newcol, $this->newcol );
				imagesetpixel( $this->t, $this->dx, $this->dy, $this->setcol );
			}
		}
	}
	function ellipse($bg_colour="FFFFFF")
	{
		$this->bgc = $bg_colour;
		$this->br = $this->hex2rgb(substr($this->bgc,0,2));
		$this->bg = $this->hex2rgb(substr($this->bgc,2,2));
		$this->bb = $this->hex2rgb(substr($this->bgc,4,2));
		$this->dot = ImageCreate(6,6);
		$this->dot_base = ImageColorAllocate($this->dot, $this->br, $this->bg, $this->bb);
		$this->zenitha = ImageColorClosest($this->t, $this->br, $this->bg, $this->bb);
		for($this->rad = 0;$this->rad<6.3;$this->rad+=0.005)
		{
			$this->xpos = floor(($this->q)+(sin($this->rad)*($this->q)))/2;
			$this->ypos = floor(($this->r)+(cos($this->rad)*($this->r)))/2;
			$this->xto = 0;
			if($this->xpos >= ($this->q/2))
			{
				$this->xto = $this->q;
			}
			ImageCopyMerge($this->t,$this->dot,$this->xpos-3,$this->ypos-3,0,0,6,6,30);
			ImageCopyMerge($this->t,$this->dot,$this->xpos-2,$this->ypos-2,0,0,4,4,30);
			ImageCopyMerge($this->t,$this->dot,$this->xpos-1,$this->ypos-1,0,0,2,2,30);
			ImageLine($this->t,$this->xpos,($this->ypos),$this->xto,($this->ypos),$this->zenitha);
		}
		ImageDestroy($this->dot);
	}
	function round_edges($edge_rad=3, $bg_colour="FFFFFF", $anti_alias=1)
	{
		$this->er = $edge_rad;
		$this->bgd = $bg_colour;
		$this->aa = min(3,$anti_alias);
		$this->br = $this->hex2rgb(substr($this->bgd,0,2));
		$this->bg = $this->hex2rgb(substr($this->bgd,2,2));
		$this->bb = $this->hex2rgb(substr($this->bgd,4,2));
		$this->dot = ImageCreate(1,1);
		$this->dot_base = ImageColorAllocate($this->dot, $this->br, $this->bg, $this->bb);
		$this->zenitha = ImageColorClosest($this->t, $this->br, $this->bg, $this->bb);
		for($this->rr = 0-$this->er; $this->rr <= $this->er; $this->rr++)
		{
			$this->ypos = ($this->rr < 0) ? $this->rr+$this->er-1 : $this->r-($this->er-$this->rr);
			for($this->cr = 0-$this->er; $this->cr <= $this->er; $this->cr++)
			{
				$this->xpos = ($this->cr < 0) ? $this->cr+$this->er-1 : $this->q-($this->er-$this->cr);
				if($this->rr !== 0 || $this->cr !== 0)
				{
					$this->d_dist = round(sqrt(($this->cr*$this->cr)+($this->rr*$this->rr)));
					$this->opaci = ($this->d_dist < $this->er-$this->aa) ? 0 : max(0, 100-(($this->er-$this->d_dist)*33));
					$this->opaci = ($this->d_dist > $this->er) ? 100 : $this->opaci;
					ImageCopyMerge($this->t,$this->dot,$this->xpos,$this->ypos,0,0,1,1,$this->opaci);
				}
			}
		}
		imagedestroy($this->dot);
	}
	function merge($merge_img="", $x_left=0, $y_top=0, $merge_opacity=70, $trans_colour="FF0000")
	{
		$this->mi = $merge_img;
		$this->xx = ($x_left < 0) ? $this->q+$x_left : $x_left;
		$this->yy = ($y_top < 0) ? $this->r+$y_top : $y_top;
		$this->mo = $merge_opacity;
		$this->tc = $trans_colour;
		$this->tr = $this->hex2rgb(substr($this->tc,0,2));
		$this->tg = $this->hex2rgb(substr($this->tc,2,2));
		$this->tb = $this->hex2rgb(substr($this->tc,4,2));
		$this->md = getimagesize($this->mi);
		$this->mw = $this->md[0];
		$this->mh = $this->md[1];
		$newwidth = $this->q;
		$newheight = $this->r /2;

		$this->mm1 = ($this->md[2] < 4) ? ($this->md[2] < 3) ? ($this->md[2] < 2) ? imagecreatefromgif($this->mi) : imagecreatefromjpeg($this->mi) : imagecreatefrompng($this->mi) : Null;
		$this->mm = ImageCreateTrueColor($newwidth,$newheight);

		imagecopyresized($this->mm, $this->mm1, 0, 0, 0, 0, $newwidth, $newheight, $this->mw, $this->mh);
		$this->mw = $newwidth;
		$this->mh = $newheight;
		for($this->ypo = 0; $this->ypo < $this->mh; $this->ypo++)
		{
			for($this->xpo = 0; $this->xpo < $this->mw; $this->xpo++)
			{
				$this->indx_ref = imagecolorat($this->mm, $this->xpo, $this->ypo);
				$this->indx_rgb = imagecolorsforindex($this->mm, $this->indx_ref);
				if(($this->indx_rgb['red'] == $this->tr) && ($this->indx_rgb['green'] == $this->tg) && ($this->indx_rgb['blue'] == $this->tb))
				{
					// transparent colour, so ignore merging this pixel
				}
				else
				{
					imagecopymerge($this->t, $this->mm, $this->xx+$this->xpo, $this->yy+$this->ypo, $this->xpo, $this->ypo, 1, 1, $this->mo);
				}
			}
		}
		imagedestroy($this->mm);
	}
	function frame($light_colour="FFFFFF", $dark_colour="000000", $mid_width=4, $frame_colour = "" )
	{
		$this->rw = $mid_width;
		$this->dh = $dark_colour;
		$this->lh = $light_colour;
		$this->frc = $frame_colour;
		$this->fr = $this->hex2rgb(substr($this->dh,0,2));
		$this->fg = $this->hex2rgb(substr($this->dh,2,2));
		$this->fb = $this->hex2rgb(substr($this->dh,4,2));
		$this->gr = $this->hex2rgb(substr($this->lh,0,2));
		$this->gg = $this->hex2rgb(substr($this->lh,2,2));
		$this->gb = $this->hex2rgb(substr($this->lh,4,2));
		$this->zen = ImageColorClosest($this->t, $this->gr, $this->gg, $this->gb);
		$this->nad = ImageColorClosest($this->t, $this->fr, $this->fg, $this->fb);
		$this->mid = ($this->frc == "") ? ImageColorClosest($this->t, ($this->gr+$this->fr)/2, ($this->gg+$this->fg)/2, ($this->gb+$this->fb)/2) : ImageColorClosest($this->t, $this->hex2rgb(substr($this->frc,0,2)), $this->hex2rgb(substr($this->frc,2,2)), $this->hex2rgb(substr($this->frc,4,2)));
		imageline($this->t, 0, 1, $this->q, 0, $this->zen);
		imageline($this->t, 0, 0, 0, $this->r, $this->zen);
		imageline($this->t, $this->q-1, 0, $this->q-1, $this->r, $this->nad);
		imageline($this->t, 0, $this->r-1, $this->q, $this->r-1, $this->nad);
		imageline($this->t, $this->rw+1, $this->r-($this->rw+2), $this->q-($this->rw+2), $this->r-($this->rw+2), $this->zen); // base in
		imageline($this->t, $this->q-($this->rw+2), $this->rw+1, $this->q-($this->rw+2), $this->r-($this->rw+2), $this->zen); // right in
		imageline($this->t, $this->rw+1, $this->rw+1, $this->q-($this->rw+1), $this->rw+1, $this->nad);
		imageline($this->t, $this->rw+1, $this->rw+1, $this->rw+1, $this->r-($this->rw+1), $this->nad);
		for($this->crw = 0; $this->crw < $this->rw; $this->crw++)
		{
			imageline($this->t, $this->crw+1, $this->crw+1, $this->q-($this->crw+1), $this->crw+1, $this->mid); // top
			imageline($this->t, $this->crw+1, $this->r-($this->crw+2), $this->q-($this->crw+1), $this->r-($this->crw+2), $this->mid); // base
			imageline($this->t, $this->crw+1, $this->crw+1, $this->crw+1, $this->r-($this->crw+1), $this->mid); //left
			imageline($this->t, $this->q-($this->crw+2), $this->crw, $this->q-($this->crw+2), $this->r-($this->crw+1), $this->mid); // right
		}
	}
	function drop_shadow($shadow_width, $shadow_colour="000000", $background_colour="FFFFFF")
	{
		$this->sw = $shadow_width;
		$this->sc = $shadow_colour;
		$this->sbr = $background_colour;
		$this->sr = $this->hex2rgb(substr($this->sc,0,2));
		$this->sg = $this->hex2rgb(substr($this->sc,2,2));
		$this->sb = $this->hex2rgb(substr($this->sc,4,2));
		$this->sbrr = $this->hex2rgb(substr($this->sbr,0,2));
		$this->sbrg = $this->hex2rgb(substr($this->sbr,2,2));
		$this->sbrb = $this->hex2rgb(substr($this->sbr,4,2));
		$this->dot = ImageCreate(1,1);
		$this->dotc = ImageColorAllocate($this->dot, $this->sr, $this->sg, $this->sb);
		$this->v = imagecreatetruecolor($this->q, $this->r);
		$this->sbc = imagecolorallocate($this->v, $this->sbrr, $this->sbrg, $this->sbrb);
		$this->rsw = $this->q-$this->sw;
		$this->rsh = $this->r-$this->sw;
		imagefill($this->v, 0, 0, $this->sbc);
		for($this->sws = 0; $this->sws < $this->sw; $this->sws++)
		{
			$this->s_opac = max(0, 90-($this->sws*(100 / $this->sw)));
			for($this->sde = $this->sw; $this->sde < $this->rsh+$this->sws+1; $this->sde++)
			{
				imagecopymerge($this->v, $this->dot, $this->rsw+$this->sws, $this->sde, 0, 0, 1, 1, $this->s_opac);
			}
			for($this->bse = $this->sw; $this->bse < $this->rsw+$this->sws; $this->bse++)
			{
				imagecopymerge($this->v, $this->dot, $this->bse, $this->rsh+$this->sws, 0, 0, 1, 1, $this->s_opac);
			}
		}
		imagecopyresampled($this->v, $this->t, 0, 1, 0, 0, $this->rsw, $this->rsh, $this->q, $this->r);
		imagecopyresampled($this->t, $this->v, 0, 0, 0, 0, $this->q, $this->r, $this->q, $this->r);
		imagedestroy($this->v);
		imagedestroy($this->dot);
	}
	function motion_blur($num_blur_lines, $background_colour="FFFFFF")
	{
		$this->nbl = $num_blur_lines;
		$this->shw = ($this->nbl*2)+1;
		$this->bk = $background_colour;
		$this->kr = $this->hex2rgb(substr($this->bk,0,2));
		$this->kg = $this->hex2rgb(substr($this->bk,2,2));
		$this->kb = $this->hex2rgb(substr($this->bk,4,2));
		$this->w = imagecreatetruecolor($this->q, $this->r);
		$this->shbc = imagecolorallocate($this->w, $this->kr, $this->kg, $this->kb);
		$this->rsw = $this->q-$this->shw;
		$this->rsh = $this->r-$this->shw;
		imagefill($this->w, 0, 0, $this->shbc);
		$this->rati = $this->r / $this->rsh;
		for($this->lst = 0; $this->lst < $this->nbl; $this->lst++)
		{
			$this->opacit = max(0, 70-($this->lst*(85 / $this->nbl)));
			for($this->yst = 0; $this->yst < $this->rsh; $this->yst++)
			{
				imagecopymerge($this->w, $this->t, $this->rsw+(2*$this->lst)+1, $this->yst+(2*$this->lst)+1, $this->q-1, $this->yst*$this->rati, 1, 1, $this->opacit);
			}
			for($this->xst = 0; $this->xst < $this->rsw; $this->xst++)
			{
				imagecopymerge($this->w, $this->t, $this->xst+(2*$this->lst)+1, $this->rsh+(2*$this->lst)+1, $this->xst*$this->rati, $this->r-1, 1, 1, $this->opacit);
			}
		}
		imagecopyresampled($this->w, $this->t, 0, 0, 0, 0, $this->rsw, $this->rsh, $this->q, $this->r);
		imagecopyresampled($this->t, $this->w, 0, 0, 1, 0, $this->q, $this->r, $this->q, $this->r);
		imagedestroy($this->w);
	}
	function manipulate()
	{
		if($this->c !== "" && $this->s !== Null)
		{
			eval("\$this->maniparray = array(".$this->c.");");
			foreach($this->maniparray as $manip)
			{
				eval("\$this->".$manip.";");
			}
		}
	}
	function create()
	{
		if($this->s !== Null)
		{
			//if($this->d !== "")
			//	{
			//ob_start();
			imagejpeg($this->t,"", $this->e);
			$content = ob_get_contents();
			ob_end_clean();
			//}
			imagedestroy($this->s);
		}
		return($content);

		return true;
	}

function getregistration($req)
  {

	switch($req){
	case 'REQ' :
		$arr=array();
		$arr=$_REQUEST;
		foreach($arr as $key=>$value)
			{
			$get_req_value[$key]=addslashes($value);

			}


	break;
	case 'POST' :
		$arr=array();
		$arr=$_POST;
		foreach($arr as $key=>$value)
			{
			$get_req_value[$key]=addslashes($value);

			}


	break;
	case 'GET' :
		$arr=array();
		$arr=$_GET;
		foreach($arr as $key=>$value)
			{
			$get_req_value[$key]=addslashes($value);

			}


	break;
	}
	return ($get_req_value);
}
}
// End Class
?>