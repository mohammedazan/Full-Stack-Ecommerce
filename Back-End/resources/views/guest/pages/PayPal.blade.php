<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Testimonials Carousel</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom CSS for testimonials -->
  <style>
    /* Custom styles for testimonials carousel */
    .testimonial-slide {
      background: #f8f9fa; /* Light gray background */
      padding: 20px;
      border-radius: 5px;
      text-align: center;
    }
    .testimonial-slide p {
      font-size: 16px;
    }
    .testimonial-slide .avatar {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      object-fit: cover;
      margin: 0 auto;
      display: block;
    }
  </style>
</head>
<body>

<div class="container py-5">
  <h2 class="text-center mb-4">Customer Testimonials</h2>
  <div id="testimonialsCarousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <!-- Testimonial Slide 1 -->
      <div class="carousel-item active">
        <div class="row justify-content-center">
          <div class="col-lg-6">
            <div class="testimonial-slide">
              <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla gravida magna sit amet dui suscipit, quis bibendum arcu fermentum. Aliquam ut dapibus lectus."</p>
              <img src="https://via.placeholder.com/100" alt="John Doe" class="avatar">
              <p><strong>John Doe</strong></p>
            </div>
          </div>
        </div>
      </div>
      <!-- Testimonial Slide 2 -->
      <div class="carousel-item">
        <div class="row justify-content-center">
          <div class="col-lg-6">
            <div class="testimonial-slide">
              <p>"Vestibulum a erat metus. Quisque fermentum libero ut risus aliquam, vel venenatis libero tristique. Phasellus in justo eu enim aliquam viverra."</p>
              <img src="https://via.placeholder.com/100" alt="Jane Smith" class="avatar">
              <p><strong>Jane Smith</strong></p>
            </div>
          </div>
        </div>
      </div>
      <!-- Testimonial Slide 3 -->
      <div class="carousel-item">
        <div class="row justify-content-center">
          <div class="col-lg-6">
            <div class="testimonial-slide">
              <p>"Pellentesque eu semper sem. Fusce vestibulum consectetur neque, vitae sollicitudin mi lacinia a. Integer mattis felis nec quam dictum."</p>
              <img src="https://via.placeholder.com/100" alt="Michael Brown" class="avatar">
              <p><strong>Michael Brown</strong></p>
            </div>
          </div>
        </div>
      </div>
      <!-- Add more slides as needed -->
    </div>
    <!-- Controls -->
    <a class="carousel-control-prev" href="#testimonialsCarousel" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#testimonialsCarousel" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>

</body>
</html>
