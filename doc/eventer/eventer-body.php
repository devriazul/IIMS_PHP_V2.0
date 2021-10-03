   

	   <div align="center"><table style="width:1200px;"  background="../images/1.jpg" border="0" cellspacing="0" cellpadding="0" >
          <tr>
            <td height="180" valign="top" style="margin:2px;padding:3px;">	<?php include("topdefault.php");?></td>
          </tr>
        </table>
</div>
<div id="eventer-events-calendar-container" style=" background-color:#00CCFF;">
          
    <div id="calendar-nav" class="calendar-nav-right">    

        <?php 
				$timezone = "Asia/Dhaka";
                if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);  


		if(isset($_GET['deptid'])){$deptid=$_GET['deptid']; }else{ $deptid=''; }
			  if(isset($_GET['coursecode'])){ $coursecode=$_GET['coursecode']; }else{ $coursecode=''; }
			  if(isset($_GET['session'])){$session=$_GET['session']; }else{ $session=''; }
			  if(isset($_GET['semester'])){ $semester=$_GET['semester']; }else{ $semester=''; }
			  if(isset($_GET['facultyid'])){ $facultyid=$_GET['facultyid']; }else{ $facultyid=''; }
			//echo "The departmentid is:".$dpetid;

			if ($eventerCalendarOptions->showMonthsNavigation == '1') {
		?>
		<span id="prev-month" class="calendar-nav-btn"><a href="index.php?eventer_year=<?php echo $eventerCalendarVars->prevYear; ?>&deptid=<?php echo $deptid; ?>&coursecode=<?php echo $coursecode; ?>&session=<?php echo $session; ?>&semester=<?php echo $semester; ?>&eventer_month=<?php  echo $eventerCalendarVars->prevMonth ?>"><?php echo $eventerCalendarVars->monthNames[$eventerCalendarVars->prevMonth - 1].' '.$eventerCalendarVars->prevYear; ?></a></span>
		<?php
			}
		?>
		<span id="selected-month-year"><?php echo $eventerCalendarVars->monthNames[$eventerCalendarVars->currentMonth - 1].' '.$eventerCalendarVars->currentYear; ?></span>
		<?php
			if ($eventerCalendarOptions->showMonthsNavigation == '1') {
		?>
		<span id="next-month" class="calendar-nav-btn"><a href="index.php?eventer_year=<?php echo $eventerCalendarVars->nextYear; ?>&deptid=<?php echo $deptid; ?>&coursecode=<?php echo $coursecode; ?>&session=<?php echo $session; ?>&semester=<?php echo $semester; ?>&eventer_month=<?php  echo $eventerCalendarVars->nextMonth ?>"><?php echo $eventerCalendarVars->monthNames[$eventerCalendarVars->nextMonth - 1].' '.$eventerCalendarVars->nextYear; ?></a></span>
		<?php
			}
		?>
        
    </div>
    <div class="clear"></div>
    <ul id="week-day-names-container">
    <?php
        for ($m = 0; $m < count($eventerCalendarVars->weekDayNames); $m++) {
            if ($m == count($eventerCalendarVars->weekDayNames) - 1) {
    ?>
        <li class="week-day week-day-last" id="week-day-<?php echo $m; ?>"><?php echo $eventerCalendarVars->weekDayNames[$m]; ?></li>
    <?php
            }
            else {
    ?>
        <li class="week-day" id="week-day-<?php echo $m; ?>"><?php echo $eventerCalendarVars->weekDayNames[$m]; ?></li>
    <?php
            }
        }
    ?>
    </ul>
    <div class="clear"></div>
    <ul id="month-dates-container">
    <?php
        if (is_callable("cal_days_in_month")) {
			$eventerCalendarVars->numDaysInMonth = cal_days_in_month(CAL_GREGORIAN, $eventerCalendarVars->currentMonth, $eventerCalendarVars->currentYear);
		}
		else {
			$eventerCalendarVars->numDaysInMonth = 2 ? ($eventerCalendarVars->currentYear % 4 ? 28 : ($eventerCalendarVars->currentYear % 100 ? 29 : ($eventerCalendarVars->currentYear %400 ? 28 : 29))) : (($eventerCalendarVars->currentMonth - 1) % 7 % 2 ? 30 : 31);
		}
		
		$eventerTimeStamp = mktime(0, 0, 0, $eventerCalendarVars->currentMonth, $eventerCalendarOptions->startingWeekDay, $eventerCalendarVars->currentYear);
        $eventerDateObject = getdate($eventerTimeStamp);
        $eventerCalendarVars->weekStartDayID = $eventerDateObject['wday'];
        
        $smsDateIterator = 1;
        
        for ($m = 1; $m <= 42; $m++) {
            // We add different css class to some of date boxes e.g. date box with current date
            $cssClasses = '';
            
            if ($m % 7 == 0) {
                $cssClasses .= ' date-box-last';
            }
            else if ($eventer_col == 0) {
                $cssClasses .= ' date-box-first';
            }
            
            if ($m >= ($eventerCalendarVars->weekStartDayID + 1) && $m <= $eventerCalendarVars->numDaysInMonth + $eventerCalendarVars->weekStartDayID) {
                
                //assign class of date-box-current to today's date box
                $eventerTodayDateObject = getdate();
                if ($smsDateIterator == $eventerTodayDateObject['mday'] && $eventerTodayDateObject['mon'] == $eventerCalendarVars->currentMonth && $eventerTodayDateObject['year'] == $eventerCalendarVars->currentYear) {
                    
					$cssClasses .= ' date-box-current';
                }
                
                $dateBoxHTML = '<li class="date-box'. $cssClasses .' date-box-row-'. ($eventer_row + 1) .'" id="date-box-'. $m .'">';
                    $dateBoxHTML .= '<div class="date-labels-wrapper">';
                        $dateBoxHTML .= '<div class="date-labels">';
                            $dateBoxHTML .= '<h1 class="date-label">'. $smsDateIterator .'</h1>';
                            //$dateBoxHTML .= '<h1 class="date-label-full">'.$eventerCalendarVars->weekDayNames[$m % 7 - 1].' '.$eventerCalendarVars->monthNames[$eventerCalendarVars->currentMonth - 1].' '.$smsDateIterator.', '.$eventerCalendarVars->currentYear.'</h1>';
							$eventerTimeStamp = mktime(0, 0, 0, $eventerCalendarVars->currentMonth, $smsDateIterator, $eventerCalendarVars->currentYear);
							
							if ($eventerCalendarOptions->dateFormat == 'UK') {
                            	$dateBoxHTML .= '<h1 class="date-label-full">'.date('l', $eventerTimeStamp).', '.$smsDateIterator.' '.$eventerCalendarVars->monthNames[$eventerCalendarVars->currentMonth - 1].', '.$eventerCalendarVars->currentYear.'</h1>';
							}
							else {
								$dateBoxHTML .= '<h1 class="date-label-full">'.date('l', $eventerTimeStamp).', '.$eventerCalendarVars->monthNames[$eventerCalendarVars->currentMonth - 1].' '.$smsDateIterator.', '.$eventerCalendarVars->currentYear.'</h1>';
							}
							
                        $dateBoxHTML .= '</div>';
                    $dateBoxHTML .= '</div>';
                    
                    $startDate = date("Y-m-d", mktime(0, 0, 0, $eventerCalendarVars->currentMonth, $smsDateIterator, $eventerCalendarVars->currentYear));
                    $endDate = date("Y-m-d", mktime(0, 0, 0, $eventerCalendarVars->currentMonth, $eventerCalendarVars->numDaysInMonth, $eventerCalendarVars->currentYear));
					$day = date('l', strtotime($startDate));
						if ($eventerCalendarOptions->repeatEvents) {
								$query = "SELECT * FROM `eventer_events` WHERE dayname!='$day'
						          AND (departmentid='$deptid' or session='$session' or coursecode='$coursecode' or semester='$semester' or facultyid='$facultyid')
								  
								  UNION SELECT * FROM `eventer_events` WHERE  dayname='$day' 
								  AND (departmentid='$deptid' or session='$session' or coursecode='$coursecode' or semester='$semester' or facultyid='$facultyid')
								  ";
						}
                    else {
									$query = "SELECT * from eventer_events WHERE dayname='$day' AND status='1' 
									AND departmentid like '%$deptid%' and session like '%$session%' and coursecode like '%$coursecode%' and semester like '%$semester%' and facultyid like '%$facultyid%'";						
					}
                    
                    $eventer_recset = mysql_query($query);
                    $eventerNumOfRows = mysql_num_rows($eventer_recset);
                    
                    if ($eventerNumOfRows) {
                        
                        $dateBoxHTML .= '<div class="date-box-close-btn"><a href="#"><span></span></a></div>';
                        $dateBoxHTML .= '<ul class="event-items-nav">';
                            $dateBoxHTML .= '<li class="date-box-back-btn"><a href="#"><span></span></a></li>';
                            if ($eventerNumOfRows > 1) {
								$dateBoxHTML .= '<li class="date-box-prev-event-btn"><a href="#"></a></li>';
                                $dateBoxHTML .= '<li class="date-box-next-event-btn"><a href="#"><span></span></a></li>';
                            }
                        $dateBoxHTML .= '</ul>';
                        
                        $dateBoxHTML .= '<div class="date-box-events-wrapper">';
                            $dateBoxHTML .= '<ul class="date-box-events">';
                                
                                $eventerEventIterator = 1;
                                while ($eventerEventRow = mysql_fetch_assoc($eventer_recset)) {
								  $dept=mysql_query("select*from tbl_department where id='$eventerEventRow[departmentid]'") or die(mysql_error());
								  $deptf=mysql_fetch_array($dept);
								  
								  $course=mysql_query("select coursename,coursecode from tbl_courses where id='$eventerEventRow[coursecode]'") or die(mysql_error());
								  $coursef=mysql_fetch_array($course);
								  
								  $tch=mysql_query("select facultyid,name from tbl_faculty where facultyid='$eventerEventRow[facultyid]'") or die(mysql_error());
								  $tchf=mysql_fetch_array($tch);
								  
								  
                                    $dateBoxHTML .= '<li class="events-list-item" id="date-box-event-'.$smsDateIterator.'-'.$eventerEventIterator++.'"><a href="#">'.$eventerEventRow['title'].'<p></p>'.'Department:'.$deptf['name'].'<p></p>'.'Course code:'.$coursef['coursecode'].'<p></p>'.'Course Name:'.$coursef['coursename'].'<p></p>Teacher:'.$tchf['name'].'<p></p>Start Time:'.$eventerEventRow['start_time'].'<p></p>'.'End Time:'.$eventerEventRow['end_time'].'<p></p>Venue:'.$eventerEventRow['venue'].'</a></li>';
                                }
                            
                            $dateBoxHTML .= '</ul>';
                            $dateBoxHTML .= '<div class="event-details-items-wrapper">';
                                $dateBoxHTML .= '<ul class="event-details-items">';
                                    
									// Restart iterating the eventer_recset by resetting the pointer to 0 index
                                    $eventerEventIterator = 1;
                                    mysql_data_seek($eventer_recset, 0);
                                    
                                    while ($eventerEventRow = mysql_fetch_assoc($eventer_recset)) {
										$image = '';
										
										if ($eventerEventRow['image'] != '') {
											$imageAlignment = $eventerEventRow['image_alignment'];
											$image = '<img src="images/'.$eventerEventRow['image'].'" class="align'.$imageAlignment.'"/>';
										}
										
                                        $dateBoxHTML .= '<li>';
                                            $dateBoxHTML .= '<div class="event-item-details-scrollbar" id="eventItemDetailsScrollbar-'.$smsDateIterator.'-'.$eventerEventIterator++.'">';
                                                $dateBoxHTML .= '<div class="scrollbar">';
                                                    $dateBoxHTML .= '<div class="track"><div class="thumb"><div class="end"></div></div></div>';
                                                $dateBoxHTML .= '</div>';
                                                $dateBoxHTML .= '<div class="viewport">';
                                                    $dateBoxHTML .= '<div class="overview">';
                                                        $dateBoxHTML .= '<div class="event-item-content">';
															
                                                            $dateBoxHTML .= '<h1 class="event-heading">'.$eventerEventRow['title'].'</h1>';
															
															 $dateBoxHTML .= '<div class="meta-panel">';
															
															if ($eventerEventRow['start_date'] != '') {
																$dateBoxHTML .= '<p class="meta-item start-date-label"><strong>Start Date: </strong>'.date($eventerCalendarVars->dateFormatLong, strtotime($eventerEventRow['start_date'])).'</p>';
															}
															
															if ($eventerEventRow['end_date'] != '') {
																$dateBoxHTML .= '<p class="meta-item end-date-label"><strong>End Date: </strong>'.date($eventerCalendarVars->dateFormatLong, strtotime($eventerEventRow['end_date'])).'</p>';
															}
															
															if ($eventerEventRow['start_time'] != '') {
																$dateBoxHTML .= '<p class="meta-item start-time-label"><strong>Start Time: </strong>'.date("g:i a", strtotime($eventerEventRow['start_time'])).'</p>';
															}
															
															if ($eventerEventRow['end_time'] != '') {
																$dateBoxHTML .= '<p class="meta-item end-time-label"><strong>End Time: </strong>'.date("g:i a", strtotime($eventerEventRow['end_time'])).'</p>';
															}
															
															if ($eventerEventRow['venue'] != '') {
																$dateBoxHTML .= '<p class="meta-item venue-label"><strong>Venue: </strong>'.$eventerEventRow['venue'].'</p>';
															}
															
															if ($eventerEventRow['link'] != '') {
																$dateBoxHTML .= '<p class="meta-item meta-item-link">'.$eventerEventRow['link'].'</p>';
															}
															
															$dateBoxHTML .= '</div>';
															
															$dateBoxHTML .= '<div class="info-panel">'.$image.$eventerEventRow['description'].'</div>';
															
															if ($eventerEventRow['link'] != '') {
																$dateBoxHTML .= '<div class="meta-panel"><p class="meta-item-link" style="margin:0;">'.$eventerEventRow['link'].'</p></div>';
															}
															
                                                        $dateBoxHTML .= '</div>';
                                                    $dateBoxHTML .= '</div>';
                                                $dateBoxHTML .= '</div>';
                                            $dateBoxHTML .= '</div>';
                                        $dateBoxHTML .= '</li>';
                                    }
                                    
                                $dateBoxHTML .= '</ul>';
                            $dateBoxHTML .= '</div>';
                        $dateBoxHTML .= '</div>';
                    }
                    
                $dateBoxHTML .= '</li>';
                
                echo $dateBoxHTML;
                
                $smsDateIterator++;
            }
            else {
                echo '<li class="date-box'. $cssClasses .' date-box-row-'. ($eventer_row + 1) .' date-box-disabled" id="date-box-'. ($m) .'"><div class="date-labels-wrapper"><div class="date-labels"><h1 class="date-label"></h1><h1 class="date-label-full"></h1></div></div></li>';
            }
            
            $eventer_col++;
            if ($eventer_col == 7) {
                $eventer_row++;
                $eventer_col = 0;
            }
			
        }
    ?>
    </ul>
	
</div>
	   <div align="center"><table width="1266"  border="0" cellspacing="0" cellpadding="0" >
          <tr>
            <td style="margin:2px;padding:3px;">	<?php include("bot.php");?></td>
          </tr>
        </table>
</div>