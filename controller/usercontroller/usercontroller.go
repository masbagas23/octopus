package UserController

import (
	"fmt"
	"log"
	"net/http"
  "github.com/gin-gonic/gin"
  "github.com/masbagas23/octopus"
)

func GetUser(c *gin.Context) {
	name := c.Param("name")
	c.String(http.StatusOK, "Hello %s", name)
}
