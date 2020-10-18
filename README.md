# php-timer
Simple Timer Class

![PHP from Packagist](https://img.shields.io/packagist/php-v/markuszeller/php-timer/v1.0.0.svg)
![Install with Composer)](https://img.shields.io/badge/composer-markuszeller%2Fphp--time-blue.svg)

Init a timer

    $timer = new Timer();
    
Do something what takes some time and stop the timer.
    
    $timer->stop();
    
Assuming the timer took 66.6 seconds for the do-something operations.

Receive the values in different formats:
    
- Fractioned with 2 decimals

      // 66.60
      echo $timer->getSecondsFractioned();
    
- Rounded as an integer

      // 67
      echo $timer->getSecondsRounded();  
    
- Formatted as time hh:mm:ss

      // 00:01:06
      echo $timer->getTimeFormatted();

- Different outputs

```
$timer->setTotal(100);
$timer->setDone(88);

// █████████████████░░░
// 20 chars are default
echo $timer->getProgressAsciiBar(), PHP_EOL;

//  88.00%
echo $timer->getProgressPercentage(), PHP_EOL;

// 88/100
echo $timer->getProgressDone(), PHP_EOL;
```

- You can also define your own output
  - %b - Progress bar
  - %c - Count
  - %p - Percentage
  
  `%c %b %p` will print  
  `  567/1234 █████████░░░░░░░░░░░  45.95%`
