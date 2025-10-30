from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.chrome.service import Service
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from webdriver_manager.chrome import ChromeDriverManager
import time

# Configuration
BASE_URL = "http://localhost:81/speedo/Speedo"
LOGIN_URL = f"{BASE_URL}/login.html"
PROFILE_URL = f"{BASE_URL}/profile.php"
USERNAME = "testuser"       # Replace with your DB user
PASSWORD = "password123"

# Setup WebDriver
driver = webdriver.Chrome(service=Service(ChromeDriverManager().install()))
driver.maximize_window()

try:
    # Step 1: Open login page
    driver.get(LOGIN_URL)

    # Wait for username field
    WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.NAME, "username"))
    )

    # Step 2: Enter credentials
    driver.find_element(By.NAME, "username").send_keys(USERNAME)
    driver.find_element(By.NAME, "password").send_keys(PASSWORD)

    # Step 3: Click login button
    driver.find_element(By.CLASS_NAME, "btn-login").click()

    # Wait for redirect
    time.sleep(3)

    # Step 4: Navigate to profile page
    driver.get(PROFILE_URL)

    # Wait for at least one profile card to appear
    WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.CLASS_NAME, "card"))
    )

    # Step 5: Extract first profile info
    fullname = driver.find_element(By.XPATH, "(//div[@class='card-body']//div[@class='row'])[1]/div[2]").text
    email = driver.find_element(By.XPATH, "(//div[@class='card-body']//div[@class='row'])[2]/div[2]").text
    username_display = driver.find_element(By.XPATH, "(//div[@class='card-body']//div[@class='row'])[3]/div[2]").text

    print(f"Profile Name: {fullname}")
    print(f"Profile Email: {email}")
    print(f"Profile Username: {username_display}")

    # Step 6: Verify profile
    assert username_display == USERNAME, "Username mismatch on profile page!"
    print("Profile verified successfully.")

except Exception as e:
    print(f"Test failed: {e}")

finally:
    time.sleep(2)
    driver.quit()
