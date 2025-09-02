<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Agent Review</title>
		<link
			rel="stylesheet"
			href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
		/>
		<link rel="stylesheet" href="{{asset('rating/asset/css/style.css')}}" />
	</head>
	<body>
		<div class="agent-rating__body">
			<div class="agent-rating__body-box">
				<h2 class="title">Rate your Agent</h2>
				<form action="{{route('store_review', ['business_id'=>$business_id])}}" method="POST">
					@csrf
					<div class="star-review-wrap">
						<span class="directionm">Click the stars to rate</span>
						<div id="full-stars-example">
							<div class="rating-group">
								<label aria-label="1 star" class="rating__label" for="rating-1"
									><i class="rating__icon rating__icon--star fa fa-star"></i
								></label>
								<input
									class="rating__input"
									name="rating"
									id="rating-1"
									value="0"
									type="radio"
								/>
								<label aria-label="2 stars" class="rating__label" for="rating-2"
									><i class="rating__icon rating__icon--star fa fa-star"></i
								></label>
								<input
									class="rating__input"
									name="rating"
									id="rating-2"
									value="25"
									type="radio"
								/>
								<label aria-label="3 stars" class="rating__label" for="rating-3"
									><i class="rating__icon rating__icon--star fa fa-star"></i
								></label>
								<input
									class="rating__input"
									name="rating"
									id="rating-3"
									value="50"
									type="radio"
									checked
								/>
								<label aria-label="4 stars" class="rating__label" for="rating-4"
									><i class="rating__icon rating__icon--star fa fa-star"></i
								></label>
								<input
									class="rating__input"
									name="rating"
									id="rating-4"
									value="75"
									type="radio"
								/>
								<label aria-label="5 stars" class="rating__label" for="rating-5"
									><i class="rating__icon rating__icon--star fa fa-star"></i
								></label>
								<input
									class="rating__input"
									name="rating"
									id="rating-5"
									value="100"
									type="radio"
								/>
							</div>
						</div>
					</div>

					<div class="collect-text-reveiw form-box">
						<label for="">Review:</label>
						<textarea name="review" placeholder="Tell us about your Agent" id="" cols="30" rows="10"></textarea>
					</div>

					<button type="submit" class="submit-review-btn">Submit Review</button>
				</form>
			</div>
		</div>
	</body>
</html>
