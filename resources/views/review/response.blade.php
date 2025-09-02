<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Dashboard</title>
		<link
			rel="stylesheet"
			href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
		<link rel="stylesheet" href="{{asset('rating/asset/css/style.css')}}" />
	</head>
	<body>
		<div class="agent-rating__body">
			<div class="agent-rating__body-box">
				<div class="review-reponse-img" style="display: flex; align-items: center; justify-content: center; padding-top: 40px;">
					<img src="{{asset('rating/asset/img/icons/success.svg')}}" alt="" class="" />
				</div>
				<h2 class="title">
					Thank you for submitting your review, we've recieved your response
				</h2>

				<div
					style="
						display: flex;
						align-items: center;
						justify-content: center;
						padding-top: 40px;
					">
					<a href="{{route('home')}}" class="primary-button">Go Home</a>
				</div>
			</div>
		</div>
	</body>
</html>
