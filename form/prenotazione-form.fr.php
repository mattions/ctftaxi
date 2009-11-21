<?php
/*
File: prenotazione-form.it.php

E' il form che viene mostrato in prenotazioni :-)

Basta dire che la pagina a cui vanno i dati è prenotazione.it.php
*/



	    $errors = $FORM->getErrors() ;
	
	    if( !empty($errors) )
		{
		    echo "<br><br>" ;
		    echo( join("<br>\r\n" ,  $errors) ) ; 
			echo "<br><br>" ;   
		
		}
	
	?>
	<div id="prenotazioni">
						<h1>Réservation</h1>
						
						<form action="prenotazioni.fr.php" method="post" name="Prenotazioni">
						<div class = "esempio">
							<p>Pour de longs voyages il est nécessaire un accord téléphonique.</p>
							<p>Tous les champs avec * sont requis.</p>
						</div>
						
						<table>
						
						<tr>
							<td class="Campo">Jour :</td>
							<td>
								<select name="giorno">
								<option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
								<option>6</option>
								<option>7</option>
								<option>8</option>
								<option>9</option>
								<option>10</option>
								<option>11</option>
								<option>12</option>
								<option>13</option>
								<option>14</option>
								<option>15</option>
								<option>16</option>
								<option>17</option>
								<option>18</option>
								<option>19</option>
								<option>20</option>
								<option>21</option>
								<option>22</option>
								<option>23</option>
								<option>24</option>
								<option>25</option>
								<option>26</option>
								<option>27</option>
								<option>28</option>
								<option>29</option>
								<option>30</option>
								<option>31</option>
								</select>
							</td>
						</tr>
						<tr>
						<td class="Campo">Mois :</td>
							<td>
								<select name="mese">
								<option>Janvier</option>
								<option>Février</option>
								<option>Mars</option>
								<option>Avril</option>
								<option>Mai</option>
								<option>Juin</option>
								<option>Juillet</option>
								<option>Août</option>
								<option>Septembre</option>
								<option>Octobre</option>
								<option>Novembre</option>
								<option>Décembre</option>
								</select>
							</td>
						</tr>
						
						<tr>
						<td class="Campo">Heures :</td>
							<td>
								<select name="ora">
								<option>00</option>
								<option>01</option>
								<option>02</option>
								<option>03</option>
								<option>04</option>
								<option>05</option>
								<option>06</option>
								<option>07</option>
								<option>08</option>
								<option>09</option>
								<option>10</option>
								<option>11</option>
								<option>12</option>
								<option>13</option>
								<option>14</option>
								<option>15</option>
								<option>16</option>
								<option>17</option>
								<option>18</option>
								<option>19</option>
								<option>20</option>
								<option>21</option>
								<option>22</option>
								<option>23</option>
								</select>
							</td>
						</tr>
						
						<tr>
						<td class="Campo">Minutes :</td>
							<td>
								<select name="minuti">
								<option>00</option>
								<option>01</option>
								<option>02</option>
								<option>03</option>
								<option>04</option>
								<option>05</option>
								<option>06</option>
								<option>07</option>
								<option>08</option>
								<option>09</option>
								<option>10</option>
								<option>11</option>
								<option>12</option>
								<option>13</option>
								<option>14</option>
								<option>15</option>
								<option>16</option>
								<option>17</option>
								<option>18</option>
								<option>19</option>
								<option>20</option>
								<option>21</option>
								<option>22</option>
								<option>23</option>
								<option>24</option>
								<option>25</option>
								<option>26</option>
								<option>27</option>
								<option>28</option>
								<option>29</option>
								<option>30</option>
								<option>31</option>
								<option>32</option>
								<option>33</option>
								<option>34</option>
								<option>35</option>
								<option>36</option>
								<option>37</option>
								<option>38</option>
								<option>39</option>
								<option>40</option>
								<option>41</option>
								<option>42</option>
								<option>43</option>
								<option>44</option>
								<option>45</option>
								<option>46</option>
								<option>47</option>
								<option>48</option>
								<option>49</option>
								<option>50</option>
								<option>51</option>
								<option>52</option>
								<option>53</option>
								<option>54</option>
								<option>55</option>
								<option>56</option>
								<option>57</option>
								<option>58</option>
								<option>59</option>
								</select>
							</td>
						</tr>
						
						<tr>
							<td class="Campo">Passagers :</td>
							<td>
								<select name="passeggeri">
								<option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
								<option>6</option>
								</select>
							</td>
						</tr>
						
						<tr>
							<td class="Campo">Enfants :</td>
							<td>
								<select name="bambini">
								<option>0</option>
								<option>1</option>
								<option>2</option>
								<option>3</option>
								</select>
							</td>
						</tr>
						
						<tr>
							<td class="Campo">Bagages: </td>
							<td>
								<table >
									<tr>
										<td><input name="bagaglio" type="radio" 
										value="<?php echo $FIELDS['bagalio']->val='SI' ?>"  />
										</td>
										<td>OUI</td>
									</tr>
									<tr>
										<td><input name="bagaglio" type="radio" 
										value="<?php echo $FIELDS['bagalio']->val='NO' ?>"/>
										</td>
										<td>NON</td>
									</tr>
								</table>
							</td>
						</tr>
						
						<tr>
							<td class="Campo">Départ* :</td>
							<td><input name="partenza" type="text" 
							value="<?php echo $FIELDS['partenza']->val ?>" size="20" maxlength="40" /></td>
						</tr>

						<tr>
							<td class="Campo">Destination* :</td>
							<td><input name="arrivo" type="text" 
							value="<?php echo $FIELDS['arrivo']->val ?>" size="20" maxlength="40"/></td>
						</tr>
									
						<tr>
							<td class="Campo">Prénom* :</td>
							<td><input name="nome" type="text" 
							value="<?php echo $FIELDS['nome']->val ?>" size="20" maxlength="15"/></td>
						</tr>
						
						<tr>
							<td class="Campo">Nom* :</td>
							<td><input name="cognome" type="text" 
							value="<?php echo $FIELDS['cognome']->val ?>" size="20" maxlength="15"/></td>
						</tr>

						<tr>
							<td class="Campo">E-Mail : <div class = "esempio"> (ex: tua_email@tuo_provider.tdl)
																</div>
							</td>
							<td><input name="e-mail" type="text" 
							value="<?php echo $FIELDS['e-mail']->val ?>" size="30" maxlength="40"/></td>
						</tr>
						
						<tr>
							<td class="Campo">Téléphone* : <div class = "esempio"> (ex: 333/123456789)</div>
							</td>
							<td><input name="telefono" type="text" 
							value="<?php echo $FIELDS['telefono']->val ?>" size="30" maxlength="40"/>
							</td>
						</tr>
						
						<tr>
						<td class="Campo" >Notes :</td>
							<td>
								<textarea name="note" rows="5" cols="20">
								</textarea>
							</td>
						</tr>
						
						<tr>
								<td>
								<p class="informativa"><b>Loi sur la protection de données personnelles*:</b></p></td>
								<td>
								<p class="informativa">I dati inseriti sono gestiti elettronicamente e custoditi con i più corretti criteri di riservatezza, nel rispetto delle 
								norme del D.Lgs 196/2003 sulla tutela dei dati personali. In qualsiasi momento può ottenere la cancellazione o l'aggiornamento 
								dei dati dietro semplice richiesta scritta indirizzata al Responsabile Dati della <img alt="ctf" src="immagini/ctf-logo-small.png" title ="CTF Taxi Soc. COOP"/>, 
								Piazzale Sordoni c/o Aeroporto Raffaello Sanzio Falconara Marittima Ancona. </p>
								<p class="informativa">Per acconsentire spuntare la casella      <input type="checkbox" name="informativa" value="<?php echo $FIELDS['informativa']->val ?>"/></p>
								</td>
							</tr>
						<tr>				
							<td>
								<?php
								//Cella vuota per il corretto allineamento dei bottoni ;)
								?>
							</td>
							<td>
							<div id="bottoni">
								<input class = "formatta_bottoni" name="invia" type="submit" />
								<input class = "formatta_bottoni" name="reset" value="reset" type="reset" />
							</div>
							</td>
						</tr>
						</table>				
						</form>
			</div>