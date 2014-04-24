#
# TDM: Course activity access.
#
# @author Luke Carrier <luke@tdm.co>
# @copyright (c) 2014 The Development Manager Ltd
#

.PHONY: all clean

TOP := $(dir $(CURDIR)/$(word $(words $(MAKEFILE_LIST)), $(MAKEFILE_LIST)))

all: build/report_tdmmodaccess.zip

clean:
	rm -rf $(TOP)build

build/report_tdmmodaccess.zip:
	mkdir -p $(TOP)build
	cp -rv $(TOP)src $(TOP)build/tdmmodaccess
	cp $(TOP)README.md $(TOP)build/tdmmodaccess
	cd $(TOP)build \
		&& zip -r report_tdmmodaccess.zip tdmmodaccess
	rm -rfv $(TOP)build/tdmmodaccess
