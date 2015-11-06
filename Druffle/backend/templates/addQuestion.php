<form name="QuestionForm" action="/backend/main.php?action=addQuestion" method="POST">
				<table>
					<tr>
						<td>
							Question
						</td>
						<td>
							<input type="text" name="question" placeholder="Question" />
							<input type="text" name="userId" value="0" />
						</td>
					</tr>
					<tr>
						
							<input type="text" name="answer" value="null"/>
					 
					</tr>
					<tr>
						<td colspan="2">
							<input type="submit" name="" value="Add" />
							</td>
					</tr>				 
				</table>
			</form>
			
<form name="QuestionForm" action="/backend/main.php?action=addShop" method="POST" enctype="multipart/form-data" >
				<table>
					<tr>
						<td>
							Shop name
						</td>
						<td>
							<input type="text" name="name" placeholder="Shop" />
							 <input type="file" name="image" /><br>
						</td>
					</tr>
					<tr>
						<td>
							Address
						</td>
						<td>
							<input type="text" name="address" placeholder="Address" />
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<input type="submit" name="" value="Add" />
							</td>
					</tr>				 
				</table>
			</form>			