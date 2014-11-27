<?php
/*
* Class: ValleyUpdate
*
* Encapsulation of functionality to process Valley Update stored on youtube
*
* Date: 16/10/2014
*/

class ValleyUpdate
{

   const VALLEY_UPDATE_USER='wearevalleychurch';

   public function getValleyUpdateUser() {
       return self::VALLEY_UPDATE_USER;
   }

   public function getValleyUpdateId() {

      // Call youtube videos by author webservice (return is xmldata)

      $ch=curl_init();
 //     $url='http://gdata.youtube.com/feeds/api/videos?author=' . self::getValleyUpdateUser(). '&orderby=published';
      $url='http://gdata.youtube.com/feeds/api/users/' . self::getValleyUpdateUser() . '/uploads';
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      $result = curl_exec($ch);
      curl_close($ch);

      // Videos returned in reverse order we need to find the id of first Valley update video

      $found = false;
      $xmlobj = simplexml_load_string($result);
      foreach($xmlobj->entry as $entry)
      {
         // Extract YouTube video id

         $id_arr=explode('/',$entry->id);
         $id=$id_arr[count($id_arr)-1]; // Extract Youtube video id

         // Check that the words Valley Update are in the title case insensitive

         $title=strtoupper(str_replace("  "," ",$entry->title));
         if ( strstr($title,"VALLEY UPDATE") != false )
         {
            $found=true;
            break; // Found so exit foreach
         }
      }
      if ( !$found )
         throw new Exception('Valley Update Not Found');

      return $id;
   }   
}
?>
