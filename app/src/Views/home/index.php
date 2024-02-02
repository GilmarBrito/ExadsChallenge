<?php
require_once dirname(__DIR__) . '/header.php';
?>

<!-- TODO: implement default header and footer -->
<div class="container">
    <div class="row">
        <div class="col-8 offset-2 text-center" style="margin-top:150px">
            <h1>Home <?= $data['database'] ?></h1>
        </div>
        <div>
            <p><a href="https://opensource.org/licenses/MIT"><img src="https://img.shields.io/badge/License-MIT-brightgreen.svg" alt="License: MIT"></a></p>
            <h1 id="exads-test">Exads test</h1>
            <p>Candidate challenge for PHP Developer position at Exads.
                Check how you can access the <a href="#challenges">challenges</a> here.</p>
            <h2 id="getting-started">Getting Started</h2>
            <p>These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.</p>
            <h3 id="installation">Installation</h3>
            <h4 id="install-using-docker-compose">Install Using Docker Compose</h4>
            <h5 id="prerequisites">Prerequisites</h5>
            <ul>
                <li><a href="https://docs.docker.com/engine/install/">Docker</a></li>
                <li><a href="https://docs.docker.com/compose/install/">Docker Compose</a></li>
            </ul>
            <h5 id="docker-environment">Docker Environment</h5>
            <ul>
                <li>PHP v8.3.2</li>
                <li>Nginx Latest</li>
                <li>MySQL v8.3.0</li>
            </ul>
            <p>Step 1 - Clone this repo:</p>
            <pre><code class="lang-BASH">git <span class="hljs-keyword">clone</span> <span class="hljs-title">git</span>@github.com:GilmarBrito/ExadsChallenge.git
</code></pre>
            <p>Step 2 - Open folder:</p>
            <pre><code class="lang-BASH"><span class="hljs-built_in">cd</span> ExadsChallenge
</code></pre>
            <p>Step 3 - Run and build the containers:</p>
            <pre><code class="lang-BASH">docker compose up <span class="hljs-comment">--build -d</span>
</code></pre>
            <p>Step 4 - Execute:</p>
            <pre><code class="lang-BASH">docker compose <span class="hljs-keyword">exec</span> php-service composer install &amp;&amp; docker compose <span class="hljs-keyword">exec</span> php-service composer <span class="hljs-keyword">dump</span>-autoload --optimize
</code></pre>
            <h2 id="challenges">Challenges</h2>
            <h3 id="1-prime-numbers">1. Prime Numbers</h3>
            <p>Write a PHP script that prints all integer values from 1 to 100.</p>
            <p>Beside each number, print the numbers it is a multiple of (inside brackets and comma-separated). If
                only multiple of itself then print “[PRIME]”.</p>
            <h4 id="execute">Execute</h4>
            <pre><code class="lang-BASH"><span class="hljs-selector-tag">docker</span> <span class="hljs-selector-tag">compose</span> <span class="hljs-selector-tag">run</span> <span class="hljs-selector-tag">php-service</span> <span class="hljs-selector-tag">php</span> <span class="hljs-selector-tag">bin</span>/<span class="hljs-selector-tag">console</span><span class="hljs-selector-class">.php</span> <span class="hljs-selector-tag">app</span><span class="hljs-selector-pseudo">:prime</span> <span class="hljs-selector-attr">[firstNumber]</span> <span class="hljs-selector-attr">[lastNumber]</span>
</code></pre>
            <table>
                <thead>
                    <tr>
                        <th>argument</th>
                        <th>type</th>
                        <th>description</th>
                        <th>mandatory</th>
                        <th>default</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>firstNumber</td>
                        <td>integer</td>
                        <td>First number of the list</td>
                        <td>no</td>
                        <td>1</td>
                    </tr>
                    <tr>
                        <td>lastNumber</td>
                        <td>integer</td>
                        <td>Last number of the list</td>
                        <td>no</td>
                        <td>100</td>
                    </tr>
                </tbody>
            </table>
            <h4 id="relevant-code-files-">Relevant code files:</h4>
            <ul>
                <li><code>app/src/Libraries/PrimeNumbers.php</code></li>
                <li><code>app/src/Console/PrimeNumbersCommand.php</code></li>
            </ul>
            <h3 id="2-ascii-array">2. ASCII Array</h3>
            <p>Write a PHP script to generate a random array containing all the ASCII characters from comma (“,”) to
                pipe (“|”). Then randomly remove and discard an arbitrary element from this newly generated array.</p>
            <p>Write the code to efficiently determine the missing character.</p>
            <h4 id="execute">Execute</h4>
            <pre><code class="lang-BASH"> <span class="hljs-selector-tag">docker</span> <span class="hljs-selector-tag">compose</span> <span class="hljs-selector-tag">run</span> <span class="hljs-selector-tag">php-service</span> <span class="hljs-selector-tag">php</span> <span class="hljs-selector-tag">bin</span>/<span class="hljs-selector-tag">console</span><span class="hljs-selector-class">.php</span> <span class="hljs-selector-tag">app</span><span class="hljs-selector-pseudo">:ascii-array</span> <span class="hljs-selector-attr">[startChar]</span> <span class="hljs-selector-attr">[lastChar]</span>
</code></pre>
            <table>
                <thead>
                    <tr>
                        <th>argument</th>
                        <th>type</th>
                        <th>description</th>
                        <th>mandatory</th>
                        <th>default</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>firstNumber</td>
                        <td>string</td>
                        <td>First Character in the list</td>
                        <td>no</td>
                        <td>&#39;,&#39;</td>
                    </tr>
                    <tr>
                        <td>lastNumber</td>
                        <td>string</td>
                        <td>Last Character in the list</td>
                        <td>no</td>
                        <td>&#39;\</td>
                        <td>&#39;</td>
                    </tr>
                </tbody>
            </table>
            <h4 id="relevant-code-files-">Relevant code files:</h4>
            <ul>
                <li><code>app/src/Libraries/ASCIIArray.php</code></li>
                <li><code>app/src/Console/ASCIIArrayCommand.php</code></li>
            </ul>
            <h3 id="3-tv-series">3. TV Series</h3>
            <p>Populate a MySQL (InnoDB) database with data from at least 3 TV Series using the following structure:</p>
            <p><code>tv_series -&gt; (id, title, channel, gender);</code></p>
            <p><code>tv_series_intervals -&gt; (id_tv_series, week_day, show_time);</code></p>
            <ul>
                <li>Provide the SQL scripts that create and populate the DB;</li>
            </ul>
            <p>Using OOP, write a code that tells when the next TV Series will air based on the current time-date or an
                inputted time-date, and that can be optionally filtered by TV Series title.</p>
            <h4 id="execute-after-run-up-docker-containers-">Execute (After run up docker containers)</h4>
            <p><a href="http://localhost:8080/series">http://localhost:8080/series</a></p>
            <h4 id="relevant-code-files-">Relevant code files:</h4>
            <ul>
                <li><code>app/src/Models/SeriesModel.php</code></li>
                <li><code>app/src/Controllers/SeriesController.php</code></li>
            </ul>
            <h3 id="4-a-b-testing">4. A/B Testing</h3>
            <p>Exads would like to A/B test some promotional designs to see which provides the best conversion rate.
                Write a snippet of PHP code that redirects end users to the different designs based on the data
                provided by this library: <a href="https://packagist.org/packages/exads/ab-test-data">packagist.org/exads/ab-test-data</a></p>
            <h4 id="execute-after-run-up-docker-containers-">Execute (After run up docker containers)</h4>
            <p><a href="http://localhost:8080/abtest">http://localhost:8080/abtest</a></p>
            <ul>
                <li>Refresh page to see A/B tests layouts</li>
            </ul>
            <h4 id="relevant-code-files-">Relevant code files:</h4>
            <ul>
                <li><code>app/src/Libraries/ABTestHandler.php</code></li>
            </ul>
            <h3 id="running-tests">Running Tests</h3>
            <pre><code class="lang-BASH">docker compose <span class="hljs-keyword">run</span><span class="bash"> composer <span class="hljs-built_in">test</span></span>
</code></pre>
            <h3 id="coverage-report">Coverage Report</h3>
            <pre><code class="lang-BASH">docker compose <span class="hljs-keyword">run</span><span class="bash"> composer coverage-report        <span class="hljs-comment"># See the report in tests/coverage/reports/index.html</span></span>
</code></pre>
            <h3 id="code-sniffer-linter">Code Sniffer Linter</h3>
            <pre><code class="lang-BASH">docker compose <span class="hljs-built_in">exec</span> php-service composer phpcs          <span class="hljs-comment"># Detect coding standards violations (PSR-1, PSR-2, PSR-12)</span>
docker compose <span class="hljs-built_in">exec</span> php-service composer phpcbf                  <span class="hljs-comment"># Try to automatically correct this coding standard violations</span>
</code></pre>
            <h3 id="static-analyser">Static Analyser</h3>
            <pre><code class="lang-BASH">docker compose <span class="hljs-built_in">exec</span> php-service composer phpstan          <span class="hljs-comment"># Run static analyser</span>
</code></pre>
            <h3 id="ps-to-run-the-application-port-8080-on-localhost-127-0-0-1-must-be-free-">PS.:To run the application, port 8080 on localhost (127.0.0.1) must be free.</h3>

        </div>
    </div>
</div>

<?php
require_once dirname(__DIR__) . '/header.php';
?>