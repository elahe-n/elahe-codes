# stackoverflow questions viewer (SQV)

This is a PHP Script which helps people who are active users on "www.stackoverflow.com" and also interested in android. 
SQV(stackoverflow questions viewer) shows 10 newest Android-related questions and the 10 most voted Android-related questions posted in the past week on one page.
In addition you can read the full information of the questions by clicking the titles.
    <P align="center"><img src="https://raw.githubusercontent.com/elahe-n/elahe-codes/master/sqv1.JPG"></p>

## How it works
SQV fetch the questions using cURL library. 
Thanks to the advanced search engine of the stackoverflow website, the script utilizes the <B>"[android] created:7d.. is:question"</B>   to access the most voted Android-related questions posted in the past week.Finally, the link will be like this:
```
https://stackoverflow.com/search?tab=votes&q=%5bandroid%5d%20created%3a7d..%20is%3aquestion
```

You can see all of its search engine options here:
```
https://stackoverflow.com/help/searching
```

In <B>load_url</B> function it uses a while to bypass the security of the website. It strives for a maximum of 30 seconds to get the div which contains the search results. It shows "stackoverflow robot has blocked You" message if cannot bypass it.

Using the <B> Document Object Model(DOM) </B>, it begins to separate the specific contents which are needed to show after getting the results. it saves the title, number of answers, votes and the summary for each question using <B>DOMXpath</B>. 
Finally, It shows the results in two separated simple div named <B> "Most voted" </B> and <B> "Newest" </B> .

## Spacial Feature
Showing votes' numbers and answers' numbers and also the summaries of the questions.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.
You can use a web server solution such as XAMPP or a web host with PHP 5 or 7 and supporting cURL library to run it on your localhost or a web host respectively. 
### Prerequisites
A host(local or web) with PHP 5 or 7 which supports cURL library.
example:
```
XAMPP
```

### Installing

just upload it on your host and open its link on your browser

online:
```
http://www.svoptik.com/elahe/sqv.php
```

## Author

* **Elahe Nourkami**
