@extends('layouts.layout')

@section('title')
    <title>Press F to Fish - A simple web game by Andrew Lerma</title>
@endsection

@section('body')
    <div id="about-container">
        <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
            <div class="row">
                <div class="col-12 text-center">
                    <img src="./images/pftf-logo.png" class="m-2 text-center img-responsive" width="350"/>
                </div>
                <div class="about-text-container">
                    <div class="row">
                        <div class="col-12">
                            <p>My name is Andrew Lerma.</p>
                            <p>I'm a web developer with over <del>{{ date('Y') - 2008 - 1 }}</del> {{ date('Y') - 2008 }} years of experience creating professional web sites and web applications.</p>
                            <hr />
                            <p>My current class schedule is as follows:</p>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Class</th>
                                        <th scope="col">Semester</th>
                                        <th scope="col">GPA</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">Interpersonal Communication</th>
                                        <td>Fall 2023</td>
                                        <td>4.0</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Composition I</th>
                                        <td>Fall 2023</td>
                                        <td>4.0</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Networking Concepts</th>
                                        <td>Winter 2024</td>
                                        <td>TBD</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">HTML5 Programming</th>
                                        <td>Winter 2024</td>
                                        <td>TBD</td>
                                    </tr>
                                </tbody>
                            </table>
                            <h2 class="text-center mt-5">Favorite Things</h2>
                            <!--three favorite sports, movies, books, tv shows-->
                            <div class="card-group card-group-scroll">
                                <div class="card">
                                    <img src="https://mdbcdn.b-cdn.net/img/new/standard/city/041.webp" class="card-img-top" alt="Hollywood Sign on The Hill" />
                                    <div class="card-body">
                                        <h5 class="card-title">My Family</h5>
                                        <p class="card-text">
                                            I've been happily married for almost ten years to my wife, Emily Elmer. Our daughter Storm has just been accepted into law school, following in her mother's footsteps.
                                        </p>
                                    </div>
                                    <div class="card-footer">
                                        <small class="text-muted">Last updated March 1st, 2024</small>
                                    </div>
                                </div>
                                <div class="card">
                                    <img src="https://mdbcdn.b-cdn.net/img/new/standard/city/042.webp" class="card-img-top" alt="Palm Springs Road" />
                                    <div class="card-body">
                                        <h5 class="card-title">Coding</h5>
                                        <p class="card-text">I'm lucky enough to earn money doing something I love. If you have any interest in coding, whatsoever, I can't recommend the career enough. I've always loved solved puzzles. For most of my adult life, I've done it professionally.</p>
                                    </div>
                                    <div class="card-footer">
                                        <small class="text-muted">Last updated March 1st, 2024</small>
                                    </div>
                                </div>
                                <div class="card">
                                    <img src="https://mdbcdn.b-cdn.net/img/new/standard/city/043.webp" class="card-img-top" alt="Los Angeles Skyscrapers" />
                                    <div class="card-body">
                                        <h5 class="card-title">Music</h5>
                                        <p class="card-text">
                                            After picking up my first guitar at the age of 14, I've spent countless hours learning most of my favorite music and occassionally writing my own.
                                        </p>
                                    </div>
                                    <div class="card-footer">
                                        <small class="text-muted">Last updated March 1st, 2024</small>
                                    </div>
                                </div>
                                <div class="card">
                                    <img src="https://mdbcdn.b-cdn.net/img/new/standard/city/044.webp" class="card-img-top" alt="Hollywood Sign on The Hill" />
                                    <div class="card-body">
                                        <h5 class="card-title">Stephen King</h5>
                                        <p class="card-text">
                                            The books. The movies. The unforgettable characters. I've read a fair share of books, and few authors are as easy to read as King. I'm eagerly keeping my fingers crossed for Mike Flanagan's Dark Tower series.  
                                        </p>
                                    </div>
                                    <div class="card-footer">
                                        <small class="text-muted">Last updated March 1st, 2024</small>
                                    </div>
                                </div>
                                <div class="card">
                                    <img src="https://mdbcdn.b-cdn.net/img/new/standard/city/045.webp" class="card-img-top" alt="Palm Springs Road" />
                                    <div class="card-body">
                                        <h5 class="card-title">Hockey</h5>
                                        <p class="card-text">I've recently grown very fond of hockey, thanks in part to the 2023-2024 success of the Detroit Red Wings. What an exciting time to watch this historic team.</p>
                                    </div>
                                    <div class="card-footer">
                                        <small class="text-muted">Last updated March 1st, 2024</small>
                                    </div>
                                </div>
                                <div class="card">
                                    <img src="https://mdbcdn.b-cdn.net/img/new/standard/city/046.webp" class="card-img-top" alt="Los Angeles Skyscrapers" />
                                    <div class="card-body">
                                        <h5 class="card-title">DIY Projects</h5>
                                        <p class="card-text">
                                            After becoming a homeowner in 2017, I quickly found that the more I learn about how every component of my house works, and the more I learn to fix myself, the better. My wife and I have recently renovated our bathroom, and couldn't be more proud of the results.
                                        </p>
                                    </div>
                                    <div class="card-footer">
                                        <small class="text-muted">Last updated March 1st, 2024</small>
                                    </div>
                                </div>
                            </div>
                            <!--link to interesting site-->
                            <h2 class="text-center mt-5">Interesting Sites</h2>
                            <p>One of my favorite things about the web, are the wide variety of experiences offered. There are countless numbers of sites that facilitate productivity, entertainment, and education. Here are a few of my favorites:</p>
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Chess.com
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <p><a href="https://chess.com" target="_blank">Chess.com</a> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Cookie Clicker
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <p><a href="https://orteil.dashnet.org/cookieclicker/" target="_blank">Cookie Clicker</a></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            CodeCademy
                                        </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <p><a href="https://codecademy.com" target="_blank">CodeCademy</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--two photos or video-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
