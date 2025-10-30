from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium import webdriver
from selenium.webdriver.chrome.service import Service
from webdriver_manager.chrome import ChromeDriverManager
import time

driver = webdriver.Chrome(service=Service(ChromeDriverManager().install()))
driver.get("http://localhost:81/speedo/Speedo/register.html")

# Fill out the form
driver.find_element(By.NAME, "fullname").send_keys("Test User")
driver.find_element(By.NAME, "email").send_keys("test@example.com")
driver.find_element(By.NAME, "username").send_keys("testuser")
driver.find_element(By.NAME, "password").send_keys("password123")
driver.find_element(By.NAME, "confirm_password").send_keys("password123")

# Wait for button and click
wait = WebDriverWait(driver, 10)
register_button = wait.until(EC.element_to_be_clickable((By.CLASS_NAME, "btn-register")))
register_button.click()

time.sleep(5)
print("Form submitted successfully.")
driver.quit()
