# php-timer
Simple Timer Class

    $timer = new Timer();
    
    // do something
    
    $timer->stop();
    
    // assume timer took 66.6 seconds
    
    // 66.60
    echo $timer->getSecondsFractioned();
    
    // 67
    echo $timer->getSecondsRounded();
    
    // 00:01:06
    echo $timer->getTimeFormatted();
