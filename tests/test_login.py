from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.chrome.service import Service
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from webdriver_manager.chrome import ChromeDriverManager
import time

# Start Chrome WebDriver
driver = webdriver.Chrome(service=Service(ChromeDriverManager().install()))

# Open the login page
driver.get("http://localhost:81/speedo/Speedo/login.html")

# Wait until username input is available
WebDriverWait(driver, 10).until(
    EC.presence_of_element_located((By.NAME, "username"))
)

# Fill out the login form
driver.find_element(By.NAME, "username").send_keys("Kiran2104")
driver.find_element(By.NAME, "password").send_keys("123456")

# Click the login button (by class, not id)
driver.find_element(By.CSS_SELECTOR, ".btn-login").click()

# Wait for page to load after submission
time.sleep(5)

# Validation — you can adjust depending on what the page displays after login
if "Profile" in driver.page_source or "Welcome" in driver.page_source:
    print("Login successful!")
else:
    print("Login failed or page content not found.")

driver.quit()
