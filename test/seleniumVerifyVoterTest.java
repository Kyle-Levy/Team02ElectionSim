import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.firefox.FirefoxDriver;

public class seleniumVerifyVoterTest
{
    public static void main(String[] args) {
        WebDriver driver = new FirefoxDriver();
        driver.get("http://localhost/webpages/login.php");
        WebElement userElement = driver.findElement(By.xpath("//*[@id='username']"));
        userElement.sendKeys("kelseyculp");
        WebElement passElement = driver.findElement(By.xpath("//*[@id='pass']"));
        passElement.sendKeys("HGW4ajP5Kv");
        WebElement button = driver.findElement(By.xpath("//*[@id='loginButton']"));
        button.click();
        WebElement verifyVoter = driver.findElement(By.xpath("/html/body/header/div/nav/ul/li[5]/a"));
        verifyVoter.click();
        WebElement confirmBtn = driver.findElement(By.xpath("/html/body/form/table/tbody/tr[2]/td[6]/input"));
        confirmBtn.click();
        WebElement submitBtn = driver.findElement(By.xpath("/html/body/form/button"));
        submitBtn.click();
        WebElement check = driver.findElement(By.xpath("/html/body/header/div/nav/ul/li[5]/a"));
        check.click();


    }
}
