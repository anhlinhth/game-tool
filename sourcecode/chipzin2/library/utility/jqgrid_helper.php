<?php
  /*
  function buildGrid( $aData ){
     $CI =& get_instance();
     $CI->load->library('jqgrid_lib');
     $jqGrid = $CI->jqgrid_lib;
     if( isset( $aData['set_columns'] ) ){
        $aProperty = array();
        foreach( $aData['set_columns'] as $sProperty ){
            if (isset($sProperty['edittype']) && $sProperty['edittype'] == 'datetimepicker')
            {
                
            }
           $aProperty[] = array(
                           $sProperty['label'] =>
                              array(
                                 'name'  => $sProperty['name'],
                                 'index' => $sProperty['name'],
                                 'width' => $sProperty['width'],
                                 'editable'    => $sProperty['editable'],
                                 'editoptions' => array(
                                                   'size'=> $sProperty['size']
                                                  )
                              )
           );
        }
        $jqGrid->setColumns( $aProperty );
     }

     if( isset( $aData['custom'] ) ){
        if( isset( $aData['custom']['button'] ) ){
           $jqGrid->setCustomButtons( array( $aData['custom']['button'] ) );
        }
        if( isset( $aData['custom']['function'] ) ){
           $jqGrid->setCustomFunctions( array( $aData['custom']['function'] ) );
        }
     }

     if( isset( $aData['div_name'] ) ){
        $jqGrid->setDivName( $aData['div_name'] );
     } else {
        $jqGrid->setDivName( 'grid' );
     }

     if( isset( $aData['source'] ) ) $jqGrid->setSourceUrl( base_url() . $aData['source'] );

     if( isset( $aData['sort_name'] ) ) $jqGrid->setSortName( $aData['sort_name'] );

     if( isset( $aData['add_url'] ) ) $jqGrid->setAddUrl( base_url() . $aData['add_url'] );

     if( isset( $aData['delete_url'] ) ) $jqGrid->setDeleteUrl( base_url() . $aData['delete_url'] );

     if( isset( $aData['edit_url'] ) ) $jqGrid->setEditUrl( base_url() . $aData['edit_url'] );

     if( isset( $aData['caption'] ) ) $jqGrid->setCaption( $aData['caption'] );

     if( isset( $aData['primary_key'] ) ) $jqGrid->setPrimaryKey( $aData['primary_key'] );

     if( isset( $aData['grid_height'] ) ) $jqGrid->setGridHeight( $aData['grid_height'] );

     if( isset( $aData['subgrid'] ) ) $jqGrid->setSubGrid($aData['subgrid']);

	 if( isset( $aData['subgrid_url'] ) ) $jqGrid->setSubGridUrl($aData['subgrid_url']);

	 if( isset( $aData['subgrid_columnnames'] ) ) $jqGrid->setSubGridColumnNames($aData['subgrid_columnnames']);

	 if( isset( $aData['subgrid_columnwidth'] ) ) $jqGrid->subGridColumnWidth($aData['subgrid_columnwidth']);

     return $jqGrid->buildGrid();
  }
  */

  function buildGridData( $aData ){
      //$CI =& get_instance();
      /*
      $isSearch         		= $CI->input->get('_search');
      $searchField      		= $CI->input->get('searchField');
      $searchString     		= $CI->input->get('searchString');
      $searchOperator   		= $CI->input->get('searchOper');
      $page    = $CI->input->get('page'); // get the requested page
      $limit   = $CI->input->get('rows'); // get how many rows we want to have into the grid
      $sidx    = $CI->input->get('sidx'); // get index row - i.e. user click to sort
      $sord    = $CI->input->get('sord'); // get the direction
      */
      
      $isSearch                 = $_POST['_search'];
      $searchField              = $_POST['searchField'];
      $searchString             = $_POST['searchString'];
      $searchOperator           = $_POST['searchOper'];
      $page    = $_POST['page']; // get the requested page
      $limit   = $_POST['rows']; // get how many rows we want to have into the grid
      $sidx    = $_POST['sidx']; // get index row - i.e. user click to sort
      $sord    = $_POST['sord']; // get the direction
        
      if($isSearch == "true") $whereParam = buildWhereClauseForSearch($searchField,$searchString,$searchOperator);
      if($isSearch == "false") $whereParam = $aData['whereParam'];
    
      $paramArr['whereParam'] 	=   $whereParam;
     
      $paramArr['reload']     	= TRUE;
      if (isset($aData['privateParams']))
      {
          foreach($aData['privateParams'] as $key=>$val)
          {
              $paramArr[$key] = $val;
          }
      }
      
      /*you can add aditional params in the where clause here:
      $paramArr['outletid']		= $CI->session->userdata(SELECTED_OUTLET);
	  $paramArr['invtypeId']	= $CI->session->userdata(SELECTED_INVENTORY_TYPE); 
	  $paramArr['postingYear'] 	= getPostingYear();
	  */
      if( isset( $aData['method'] ) && isset( $aData['model'] ) ){
          
         //$CI->load->model( $aData['model'] );
         //$aDataList = $CI->$aData['model']->$aData['method']($paramArr);
         $aDataList = $aData['model']->$aData['method']($paramArr);
         $count = count($aDataList);
         if( $count >0 ) $total_pages = ceil($count/$limit);
         else $total_pages = 0;

         if ($page > $total_pages) $page=$total_pages;
         $start = $limit*$page - $limit;

         if ($start < 0)
         {
             $start = 0;
         }
         if ($limit < 0)
         {
             $limit = 0;
         }
            $paramArr['start']      = $start;
         //if ($limit)
            $paramArr['limit']      = $limit;
         if ($sidx != '')
            $paramArr['sortField']  = $sidx;
         //if ($sord)
            $paramArr['sortOrder']  = $sord;
         //if ($whereParam)
            $paramArr['whereParam'] = $whereParam;
         $paramArr['reload']     = TRUE;
         //$aDataList = $CI->$aData['model']->$aData['method']($paramArr);
         $aDataList = $aData['model']->$aData['method']($paramArr);
         
         $i=0;
         if( isset( $aData['columns'] ) ){
            foreach ($aDataList as $row)
            {
               $columnData = array();
               $column = array();
               foreach( $aData['columns'] as $sData ){
                  array_push( $columnData, $row[$sData] );
                  array_push( $column, $sData );
               }
               $rs->rows[$i]['id']     = $columnData[0];//$row->$aData['id'];
               $rs->rows[$i]['cell']   = $columnData ;
               $i++;
            }
         }
         $rs->cols      = $column;
         $rs->page      = $page;
         $rs->total     = $total_pages;
         $rs->records   = $count;
         
         //$test = json_encode($rs);
         //echo $test;
        
         echo json_encode($rs);
      }
  }

    function buildWhereClauseForSearch($searchField,$searchString,$searchOperator) {
		$searchString = mysql_real_escape_string($searchString);
		$searchField = mysql_real_escape_string($searchField);
		$operator['eq'] = "$searchField='$searchString'"; //equal to
		$operator['ne'] = "$searchField<>'$searchString'"; //not equal to
		$operator['lt'] = "$searchField < $searchString"; //less than
		$operator['le'] = "$searchField <= $searchString "; //less than or equal to
		$operator['gt'] = "$searchField > $searchString"; //less than
		$operator['ge'] = "$searchField >= $searchString "; //less than or equal to
		$operator['bw'] = "$searchField like '$searchString%'"; //begins with
		$operator['bn'] = "$searchField not like '$searchString%'"; //not begins with
		$operator['in'] = "$searchField in ($searchString)"; //in
		$operator['ni'] = "$searchField not in ($searchString)"; //not in
		$operator['ew'] = "$searchField like '%$searchString'"; //ends with
		$operator['en'] = "$searchField not like '%$searchString%'"; //not ends with
		$operator['cn'] = "$searchField like '%$searchString%'"; //in
		$operator['nc'] = "$searchField not like '%$searchString%'"; //not in
		$operator['nu'] = "$searchField is null"; //is null
		$operator['nn'] = "$searchField is not null"; //is not null

		if(isset($operator[$searchOperator])) {
			return $operator[$searchOperator];
		} else {
			return null;
		}
	}
