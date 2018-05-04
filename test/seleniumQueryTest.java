import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.firefox.FirefoxDriver;

public class seleniumQueryTest {
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
        WebElement electionDemoBttn = driver.findElement(By.xpath("/html/body/header/div/nav/ul/li[7]/a"));
        electionDemoBttn.click();
        WebElement dropDownBtn = driver.findElement(By.xpath("//*[@id='electionNames']"));
        dropDownBtn.click();
        WebElement icElectionOption = driver.findElement(By.xpath("/html/body/form/select/option[5]"));
        icElectionOption.click();
        WebElement submitBttn = driver.findElement(By.xpath("/html/body/form/input"));
        submitBttn.click();

    }
}
