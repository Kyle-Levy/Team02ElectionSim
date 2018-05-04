 import org.openqa.selenium.By;
 import org.openqa.selenium.WebElement;
 import org.openqa.selenium.firefox.*;
 import org.openqa.selenium.WebDriver;

 public class seleniumLogInTest
{
    public static void main(String[] args)
    {
        WebDriver driver = new FirefoxDriver();
        driver.get("http://localhost/webpages/login.php");
        WebElement userElement = driver.findElement(By.xpath("//*[@id='username']"));
        userElement.sendKeys("kelseyculp");
        WebElement passElement = driver.findElement(By.xpath("//*[@id='pass']"));
        passElement.sendKeys("HGW4ajP5Kv");
        WebElement button = driver.findElement(By.xpath("//*[@id='loginButton']"));
        button.click();
    }
}
